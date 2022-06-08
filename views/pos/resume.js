$(`#form`)
  .on("beforeSubmit", function (e) {
    e.preventDefault();
    var btn = $(".btn-submit");
    var html = btn.html();
    setBtnLoading(btn, "Menyimpan");
    var formURL = $("#form").attr("action");
    $.ajax({
      url: formURL,
      type: "post",
      dataType: "json",
      data: $(`#form`).serialize(),
      success: function (result) {
        if (result.s) {
          successMsg(result.e);
          resetBtnLoading(btn, html);
          $.pjax.reload({
            container: "#resume",
            async: false,
          });
        } else {
    
            errorMsg(result.e)
          resetBtnLoading(btn, html);
        }
      },
      error: function (xhr, status, error) {
        errorMsg(error);
        resetBtnLoading(btn, html);
      },
    });
  })
  .on("submit", function (e) {
    e.preventDefault();
  });
