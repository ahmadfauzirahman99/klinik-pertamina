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
          // $.pjax.reload({
          //     container: "#pjax-pasien",
          //     async: false,
          // });
          setTimeout(() => {
            location.replace("http://pakning.rs-syafira.com/pasien/update?id=" + result.id);
          }, 1500);
          // $('.btn-next').show('slow');
          // $('.progress-daftar').removeClass('inactive progress-bar-warning').addClass('progress-bar-success active').find('.status-icon').html('<i class=\'fa fa-check-circle\'></i>');
        } else {
          // $.each(result.e, function (i, v) {
          //   errorMsg(v);
          // });
          errorMsg(result.e)
          resetBtnLoading(btn, html);
        }
      },
      error: function (xhr, status, error) {
        errorMsg(error);
        resetBtnLoading(btn, html);
      },
    });
    // Swal.fire({
    //     title: "Apakah Anda Sudah Yakin Ingin Menutup Kasus Pasien Ini?",
    //     text: "Silahkan Cek Kembali Untuk Inputan!!!",
    //     type: "warning",
    //     showCancelButton: !0,
    //     confirmButtonText: "Ya, Simpan",
    //     cancelButtonText: "Tidak, Periksa Kembali!",
    //     confirmButtonClass: "btn btn-success mt-2",
    //     cancelButtonClass: "btn btn-danger ml-2 mt-2",
    //     buttonsStyling: !1
    // }).then(function (t) {
    //     console.log(t.value);
    //     if (t.value) {

    //     } else if (t.dismiss === swal.DismissReason.cancel) {
    //         $('#btn-submit').prop('disabled', false);

    //         Swal.fire({
    //             title: "Cancelled",
    //             text: "Silahkan Cek Kembali Inputan Anda :)",
    //             type: "error"
    //         });
    //     }

    // });
  })
  .on("submit", function (e) {
    e.preventDefault();
  });
