let onFocusSelectRacikan = (data) => {
  $(data).select();
};

let inputJumlahHargaJualRacikan = (data) => {
  $(data).trigger("change");
  let index = $(data).closest("tr").index();
  // let index_luar = $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1
  let index_luar = $(data).closest(".form-options-item-racikan").index(); // $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1;
  // console.log("index_luar, index");
  // console.log(index_luar, index);
  // console.log("index_luar, index");

  let jumlah = parseFloat(
    $(`#racikandetail-${index_luar}-${index}-jumlah`).val()
  );
  let harga_jual = parseFloat(
    $(`#racikandetail-${index_luar}-${index}-harga_jual`).val()
  );
  let subtotal = jumlah * harga_jual;
  $(`#racikandetail-${index_luar}-${index}-subtotal-disp`)
    .val(subtotal)
    .trigger("change");
    
    // generateTotalBiayaRacikan();
};

let onChangeSubtotalRacikan = (inilah) => {
  // alert('on ceng')
  // console.log("inilah");
  // console.log(inilah);
  // console.log("inilah");
  let totalSubtotal = 0;
  // $(".dynamicform_wrapper1 .form-options-item-racikan").each(function (index) {
  $(this)
    .closest(".form-options-item-racikan")
    .each(function (index) {
      totalSubtotal =
        parseFloat($(this).find("input[name*='[subtotal]']").val()) +
        totalSubtotal;
    });
    generateTotalBiayaRacikan();
};

let enterNewRowRacikan = (data, key) => {
  let index = $(data).closest("tr").index();
  let index_luar =
    $(".dynamicform_wrapper1 .form-options-item-racikan").length - 1;

  if (key === 13) {
    const banyakBaris = $(
      ".dynamicform_wrapper1 .form-options-item-racikanform-options-item"
    ).length;
    if (banyakBaris === index + 1) {
      $(".add-item").click();
      $(data).trigger("change");
    } else {
      $(`#racikandetail-${index_luar}-${index + 1}-id_racikan_detail`).select2(
        "open"
      );
      $(data).trigger("change");
    }
  }
};

hotkeys.filter = ({ target }) => {
  return true;
  // console.log(target.tagName);
  // return target.tagName === 'INPUT' || target.tagName === 'DIV' || target.tagName === 'BODY';
  // return !(target.tagName === 'INPUT' && target.type !== 'radio') ;
};

hotkeys("alt+u,alt+y", function (event, handler) {
  event.preventDefault();
  switch (handler.key) {
    case "alt+r":
      $(`#resep-no_rm`).select2("open");
      break;
    case "alt+y":
      $(".add-item-racikan").click();
      return false;
      break;
    case "alt+u":
      $(".add-item-obat-racikan-detail").click();
      return false;
      break;
    case "alt+d":
      $("#resep-diskon_persen-disp").focus();
      return false;
      break;
    case "alt+s":
      $(".btn-simpan-form-obat").click();
      return false;
      break;
    default:
      alert(event);
  }
});

function generateTotalBiayaRacikan() {
  all_total = 0;
  $('.det_subtotal_parent > input[type="hidden"]').each(function (
    index,
    currentElement
  ) {
    // console.log($(currentElement).val())
    all_total += parseInt($(currentElement).val());
  });
  console.log(all_total);
  $("#tuslah-total_biaya_racikan-disp").val(all_total);
  $("#tuslah-total_biaya_racikan").val(all_total);
}
