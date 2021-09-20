/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-19 10:52:58
 */

$(document).ready(function () {

    fungsi()

    // $(document).on('submit','#form-penjualan',function(){
    //     $('#btn-simpan-penjualan').prop('disabled', true)
    //  });
    jQuery('#form-penjualan').on('beforeSubmit', function (event) {
        if (jQuery(this).data('submitting')) {
            event.preventDefault();
            return false;
        }
        $('#btn-simpan-penjualan').prop('disabled', true)
        jQuery(this).data('submitting', true);
        return true;
    });

    // event setelah tambah row
    $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        const index = $(".dynamicform_wrapper .form-options-item").length - 1

        // validasiJumlah()

        // update - agar select2 tidak terselect
        $(item).find("select[name*='[id_barang]']").val(null).trigger('change')

        $(item).find("select[name*='[id_barang]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            let barangDipilih = e.params.data

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper .form-options-item').each(function (e) {
                let id_barang_sudah_dipilih = $(this).find("select[name*='[id_barang]']").val()
                if (id_barang_sudah_dipilih == barangDipilih.id) {
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
                $(`#resepdetail-${index}-id_barang`).val(null).trigger("change")
                $(`#resepdetail-${index}-id_barang`).select2("open")
                toastr.error('Upps,, Item sudah dipilih ya Bund. Coba yang lain ya')
            } else {
                $($(this).closest("tr")).find(".div-fornas").html(barangDipilih.fornas)

                $(`#resepdetail-${index}-is_fornas`).prop(`checked`, barangDipilih.is_fornas)

                $(`#resepdetail-${index}-stok_saat_jual-disp`).val(barangDipilih.stok_depo).trigger("change")
                $(`#resepdetail-${index}-harga_satuan-disp`).val(barangDipilih.harga_jual).trigger("change")
                let subtotal = $(`#resepdetail-${index}-jumlah`).val() * barangDipilih.harga_jual
                $(`#resepdetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#resepdetail-${index}-jumlah-disp`).focus()
            }
        })

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })

        $(item).find('.signa-typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            name: 'signa-typeahead',
            source: new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: `${baseUrl}/api-internal/penjualan-signa-typea-head?q=%QUERY`,
                    wildcard: '%QUERY'
                }
            })
        })
        $(item).find('.catatan-typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 0
        }, {
            name: 'signa-typeahead',
            source: new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: `${baseUrl}/api-internal/penjualan-catatan-typea-head?q=%QUERY`,
                    wildcard: '%QUERY'
                }
            })
        })

        $(`#resepdetail-${index}-id_barang`).select2('open')
        $('[data-toggle="tooltip"]').tooltip()

    })

    $(".dynamicform_wrapper").on("afterDelete", function (e) {

        // validasiJumlah()

        $(".dynamicform_wrapper .form-options-item").each(function (index) {
            $(this).find('.nomor').html((index + 1))
            $(this).find('.det_satuan').attr('id', 'det_satuan_' + index)
        })
        $(`#resepdetail-0-subtotal-disp`).trigger('change')
    })

})