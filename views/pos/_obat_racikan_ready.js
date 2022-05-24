
// $(".dynamicform_wrapper_obat").on("afterInsert", function (e, item) {
$(".dynamicform_wrapper1").find('.dynamicform_wrapper_obat').on(
  "afterInsert",
  function (e, item) {
    //   alert();
    $(item).find("select[id*='racikandetail-']").val(null).trigger("change");
    // console.log($(item).find("select[id*='racikandetail-']"));
  }
);

$(".dynamicform_wrapper1").on(
  "afterInsert",
  function (e, item) {
    //   alert();
    $(item).find("select[id*='racikandetail-']").val(null).trigger("change");
    // console.log($(item).find("select[id*='racikandetail-']"));
    $(item).find('.dynamicform_wrapper_obat').on(
        "afterInsert",
        function (e, item) {
            //   alert();
            $(item).find("select[id*='racikandetail-']").val(null).trigger("change");
            // console.log($(item).find("select[id*='racikandetail-']"));
        }
        );
  }
);

function ubahSelect2(anu){
    
    // alert(12345)
    const index = $(".dynamicform_wrapper_obat .form-options-item-obat-racikan-detail").length - 1;
    const index_luar = $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1;


    console.log("sadasdas");


    $(".dynamicform_wrapper1 .form-options-item-racikan").each(function (index) {
        $(this).find('.nomor-racikan').html((index + 1))
    })
    // console.log(index);
    $(anu).find("select[name*='[id_racikan_detail]']").val(null).trigger('change')
    
    //   alert(2134324234);
    console.log(anu);
    $(anu).on('select2:select', function (e) {
            // alert("dalam")
            // console.log($(this)); // adalah <select id=...
            let index_luar = $(this).closest(".form-options-item-racikan").index(); // $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1;
            let index = $(this).closest("tr").index()
            console.log('Indexnya ', index);
            let barangDipilih = e.params.data
            console.log(barangDipilih);

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

            // if (uda_dipilih == 2) {
            //     $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).val(null).trigger("change")
            //     $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).select2("open")
            //     toastr.error('Upps,, Item sudah dipilih Bund. Coba yang lain ya')
            // } else {
                $(`#racikandetail-${index_luar}-${index}-harga_jual-disp`).val(barangDipilih.harga_jual).trigger("change")
                let subtotal = $(`#racikandetail-${index_luar}-${index}-jumlah`).val() * barangDipilih.harga_jual
                $(`#racikandetail-${index_luar}-${index}-subtotal-disp`).val(subtotal).trigger("change")
                $(`#racikandetail-${index_luar}-${index}-jumlah-disp`).focus()
            // }


        })
        // $(`#racikandetail-${index_luar}-${index}-id_racikan_detail`).select2('open')

        $(".dynamicform_wrapper_obat .form-options-item-obat-racikan-detail").each(function (index) {
            $(this).find('.nomor-racikan-detail').html((index + 1))
        })
        // alert()
        // $(this).closest(".det_jumlah").val(1234567).change();
        // generateTotalBiayaRacikan();
}

$(document).ready(function () {






   

});


