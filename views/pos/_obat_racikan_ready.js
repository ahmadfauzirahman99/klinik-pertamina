
$(document).ready(function () {

    $(".dynamicform_wrapper_obat").on("afterInsert", function (e, item) {
        const index = $(".dynamicform_wrapper_obat .form-options-item-obat-racikan-detail").length - 1
        const index_luar = $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1


        console.log("sadasdas");


        $(".dynamicform_wrapper1 .form-options-item-racikan").each(function (index) {
            $(this).find('.nomor-racikan').html((index + 1))
        })
        // console.log(index);
        $(item).find("select[name*='[id_racikan_detail]']").val(null).trigger('change')

        $(item).find("select[name*='[id_racikan_detail]']").on('select2:select', function (e) {
            let index = $(this).closest("tr").index()
            console.log('Indexnya ', index);
            let barangDipilih = e.params.data

            // cek item sudah dipilih atau belum
            let uda_dipilih = 0
            $('.dynamicform_wrapper_obat .form-options-item-obat-racikan-detail').each(function (e) {
                let id_barang_sudah_dipilih = $(this).find("select[name*='[id_racikan_detail]']").val()
                if (id_barang_sudah_dipilih == barangDipilih.id) {
                    uda_dipilih++
                    if (uda_dipilih == 2) {
                        return false
                    }
                }
            })

            if (uda_dipilih == 2) {
                $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).val(null).trigger("change")
                $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).select2("open")
                toastr.error('Upps,, Item sudah dipilih Bund. Coba yang lain ya')
            } else {
                $(`#racikandetail-${index_luar}-${index}-harga_jual-disp`).val(barangDipilih.harga_jual).trigger("change")
                let subtotal = $(`#racikandetail-${index_luar}-${index}-jumlah`).val() * barangDipilih.harga_jual
                $(`#racikandetail-${index_luar}-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#racikandetail-${index_luar}-${index}-jumlah-disp`).focus()
            }


        })
        $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).select2('open')

        $(".dynamicform_wrapper_obat .form-options-item-obat-racikan-detail").each(function (index) {
            $(this).find('.nomor-racikan-detail').html((index + 1))
        })
    })

});


