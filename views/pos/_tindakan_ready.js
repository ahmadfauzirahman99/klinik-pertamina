/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-25 16:36:31
 */

$(document).ready(function () {

    fungsi()

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
            let tindakanDipilih = e.params.data

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper .form-options-item').each(function (e) {
                let id_tindakan_sudah_dipilih = $(this).find("select[name*='[id_tindakan]']").val()
                if (id_tindakan_sudah_dipilih == tindakanDipilih.id) {
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
                $(`#layanandetail-${index}-id_tindakan`).val(null).trigger("change")
                $(`#layanandetail-${index}-id_tindakan`).select2("open")
                toastr.error('Upps,, Item sudah dipilih Bund. Coba yang lain ya')
            } else {
                $(`#layanandetail-${index}-harga_jual-disp`).val(tindakanDipilih.harga_jual).trigger("change")
                let subtotal = $(`#layanandetail-${index}-jumlah`).val() * tindakanDipilih.harga_jual
                $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#layanandetail-${index}-jumlah-disp`).focus()
            }


        })

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })

        $(`#layanandetail-${index}-id_tindakan`).select2('open')
        $('[data-toggle="tooltip"]').tooltip()

    })

    $(".dynamicform_wrapper").on("afterDelete", function (e) {

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#layanandetail-0-subtotal-disp`).trigger('change')
    })

})