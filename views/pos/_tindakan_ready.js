/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 11:43:14
 */

$(document).ready(function () {

    fungsi()

    // $(document).on('submit','#form-tindakan',function(){
    //     $('#btn-simpan-penjualan').prop('disabled', true)
    //  });
    jQuery('#form-tindakan').on('beforeSubmit', function (event) {
        if (jQuery(this).data('submitting')) {
            event.preventDefault();
            return false;
        }
        $('#btn-simpan-form-tindakan').prop('disabled', true)
        jQuery(this).data('submitting', true);
        return true;
    });

    // event setelah tambah row
    $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        const index = $(".dynamicform_wrapper .form-options-item").length - 1

        // validasiJumlah()

        // update - agar select2 tidak terselect
        $(item).find("select[name*='[id_tindakan]']").val(null).trigger('change')

        $(item).find("select[name*='[id_tindakan]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            let itemlabDipilih = e.params.data

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper .form-options-item').each(function (e) {
                let id_tindakan_sudah_dipilih = $(this).find("select[name*='[id_tindakan]']").val()
                if (id_tindakan_sudah_dipilih == itemlabDipilih.id) {
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
                $(`#layanandetail-${index}-id_tindakan`).val(null).trigger("change")
                $(`#layanandetail-${index}-id_tindakan`).select2("open")
                toastr.error('Upps,, Item sudah dipilih ya Bund. Coba yang lain ya')
            } else {
                $(`#layanandetail-${index}-harga_tindakan-disp`).val(itemlabDipilih.harga_tindakan).trigger("change")
                let subtotal = $(`#layanandetail-${index}-jumlah`).val() * itemlabDipilih.harga_tindakan
                $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#layanandetail-${index}-jumlah-disp`).focus()
            }


        })

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            // $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })

        // $(item).find('.signa-typeahead').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 0
        // }, {
        //     name: 'signa-typeahead',
        //     source: new Bloodhound({
        //         datumTokenizer: Bloodhound.tokenizers.whitespace,
        //         queryTokenizer: Bloodhound.tokenizers.whitespace,
        //         remote: {
        //             url: `${baseUrl}/api-internal/penjualan-signa-typea-head?q=%QUERY`,
        //             wildcard: '%QUERY'
        //         }
        //     })
        // })
        // $(item).find('.catatan-typeahead').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 0
        // }, {
        //     name: 'signa-typeahead',
        //     source: new Bloodhound({
        //         datumTokenizer: Bloodhound.tokenizers.whitespace,
        //         queryTokenizer: Bloodhound.tokenizers.whitespace,
        //         remote: {
        //             url: `${baseUrl}/api-internal/penjualan-catatan-typea-head?q=%QUERY`,
        //             wildcard: '%QUERY'
        //         }
        //     })
        // })

        $(`#layanandetail-${index}-id_tindakan`).select2('open')
        $('[data-toggle="tooltip"]').tooltip()

    })

    $(".dynamicform_wrapper").on("afterDelete", function (e) {

        // validasiJumlah()

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            // $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#layanandetail-0-subtotal-disp`).trigger('change')
    })

})