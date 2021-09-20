function setBtnLoading(btn, txt = "") {
    btn
        .html('<i class="fas fa-spinner fa-spin fa-fw"></i> ' + txt)
        .attr("disabled", true);
}

function resetBtnLoading(btn, htm) {
    btn.html(htm).removeAttr("disabled");
}

function errorMsg(txt) {
    if (typeof txt == "object") {
        $.each(txt, function (i, v) {
            toastr["error"](v);
        });
    } else {
        toastr["error"](txt);
    }
}

function successMsg(txt) {
    toastr["success"](txt);
}

$(function () {
    $('[data-rel="tooltip"]').tooltip()
})

$("#pj-site-index").on("pjax:end", function () {
    $('[data-rel="tooltip"]').tooltip()
})

// $(document).on('select2:open', () => {
//     document.querySelector('.select2-search__field').focus();
// });