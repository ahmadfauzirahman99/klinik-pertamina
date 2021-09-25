/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
<<<<<<< HEAD
 * @Last Modified time: 2021-09-21 14:19:08
=======
 * @Last Modified time: 2021-09-25 16:36:31
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
 */

$(document).ready(function () {

    fungsi()

<<<<<<< HEAD
    // $(document).on('submit','#form-obat',function(){
    //     $('#btn-simpan-penjualan').prop('disabled', true)
    //  });
    jQuery('#form-obat').on('beforeSubmit', function (event) {
=======
    jQuery('#form-tindakan').on('beforeSubmit', function (event) {
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
        if (jQuery(this).data('submitting')) {
            event.preventDefault();
            return false;
        }
<<<<<<< HEAD
        $('#btn-simpan-form-obat').prop('disabled', true)
=======
        $('#btn-simpan-form-tindakan').prop('disabled', true)
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
        jQuery(this).data('submitting', true);
        return true;
    });

    // event setelah tambah row
    $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        const index = $(".dynamicform_wrapper .form-options-item").length - 1

        // validasiJumlah()

        // update - agar select2 tidak terselect
<<<<<<< HEAD
        $(item).find("select[name*='[item_pemeriksaan]']").val(null).trigger('change')

        $(item).find("select[name*='[item_pemeriksaan]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            let itemlabDipilih = e.params.data
=======
        $(item).find("select[name*='[id_tindakan]']").val(null).trigger('change')

        $(item).find("select[name*='[id_tindakan]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            let tindakanDipilih = e.params.data
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper .form-options-item').each(function (e) {
<<<<<<< HEAD
                let item_pemeriksaan_sudah_dipilih = $(this).find("select[name*='[item_pemeriksaan]']").val()
                if (item_pemeriksaan_sudah_dipilih == itemlabDipilih.id) {
=======
                let id_tindakan_sudah_dipilih = $(this).find("select[name*='[id_tindakan]']").val()
                if (id_tindakan_sudah_dipilih == tindakanDipilih.id) {
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
<<<<<<< HEAD
                $(`#orderlabdetail-${index}-item_pemeriksaan`).val(null).trigger("change")
                $(`#orderlabdetail-${index}-item_pemeriksaan`).select2("open")
                toastr.error('Upps,, Item sudah dipilih ya Bund. Coba yang lain ya')
            } else {
                $(`#orderlabdetail-${index}-harga_tindakan-disp`).val(itemlabDipilih.harga_tindakan).trigger("change")
                let subtotal = $(`#orderlabdetail-${index}-jumlah`).val() * itemlabDipilih.harga_tindakan
                $(`#orderlabdetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#orderlabdetail-${index}-jumlah-disp`).focus()
=======
                $(`#layanandetail-${index}-id_tindakan`).val(null).trigger("change")
                $(`#layanandetail-${index}-id_tindakan`).select2("open")
                toastr.error('Upps,, Item sudah dipilih Bund. Coba yang lain ya')
            } else {
                $(`#layanandetail-${index}-harga_jual-disp`).val(tindakanDipilih.harga_jual).trigger("change")
                let subtotal = $(`#layanandetail-${index}-jumlah`).val() * tindakanDipilih.harga_jual
                $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#layanandetail-${index}-jumlah-disp`).focus()
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
            }


        })

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
<<<<<<< HEAD
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
=======
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })

        $(`#layanandetail-${index}-id_tindakan`).select2('open')
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
        $('[data-toggle="tooltip"]').tooltip()

    })

    $(".dynamicform_wrapper").on("afterDelete", function (e) {

<<<<<<< HEAD
        // validasiJumlah()

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            // $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#orderlabdetail-0-subtotal-disp`).trigger('change')
=======
        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#layanandetail-0-subtotal-disp`).trigger('change')
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
    })

})