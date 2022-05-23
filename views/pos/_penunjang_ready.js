/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-21 14:19:08
 */

$(document).ready(function () {

    fungsi()

    // $(document).on('submit','#form-penunjang',function(){
    //     $('#btn-simpan-penjualan').prop('disabled', true)
    //  });
    jQuery('#form-penunjang').on('beforeSubmit', function (event) {
        if (jQuery(this).data('submitting')) {
            event.preventDefault();
            return false;
        }
        $('#btn-simpan-form-penunjang').prop('disabled', true)
        jQuery(this).data('submitting', true);
        return true;
    });

    // event setelah tambah row
    $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        const index = $(".dynamicform_wrapper .form-options-item").length - 1

        // validasiJumlah()

        // update - agar select2 tidak terselect
        $(item).find("select[name*='[item_pemeriksaan]']").val(null).trigger('change')

        $(item).find("select[name*='[item_pemeriksaan]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            let itemlabDipilih = e.params.data

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper .form-options-item').each(function (e) {
                let item_pemeriksaan_sudah_dipilih = $(this).find("select[name*='[item_pemeriksaan]']").val()
                if (item_pemeriksaan_sudah_dipilih == itemlabDipilih.id) {
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
                $(`#orderlabdetail-${index}-item_pemeriksaan`).val(null).trigger("change")
                $(`#orderlabdetail-${index}-item_pemeriksaan`).select2("open")
                toastr.error('Upps,, Item sudah dipilih ya Bund. Coba yang lain ya')
            } else {
                $(`#orderlabdetail-${index}-harga_tindakan-disp`).val(itemlabDipilih.harga_tindakan).trigger("change")
                let subtotal = $(`#orderlabdetail-${index}-jumlah`).val() * itemlabDipilih.harga_tindakan
                $(`#orderlabdetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#orderlabdetail-${index}-jumlah-disp`).focus()
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

        $(`#orderlabdetail-${index}-item_pemeriksaan`).select2('open')
        $('[data-toggle="tooltip"]').tooltip()

    })

    $(".dynamicform_wrapper").on("afterDelete", function (e) {

        // validasiJumlah()

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            // $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#orderlabdetail-0-subtotal-disp`).trigger('change')
    })

})