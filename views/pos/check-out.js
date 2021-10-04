/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-10-04 15:18:43 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-10-04 16:19:09
 */

$(document).ready(function (e) {
    initJs()
})

$(document).on('pjax:success', function () {
    initJs()
})

let initJs = _ => {
    $('#btn-bayar').on('click', function (e) {
        e.preventDefault()

        let nama_lengkap = $('#pasien-nama_lengkap').val()

        let no_daftar = $('#pendaftaran-id_pendaftaran').val()
        let no_rm = $('#checkout-no_rm').val()
        let total_harga = $('#checkout-total_biaya').val()
        let total_bayar = $('#checkout-sisa_pembayaran').val()
        let total_bayar_teks = $('#checkout-sisa_pembayaran-disp').val()

        let btn = $(this)
        let html = btn.html()
        let href = $(this).attr('href')

        console.log(href);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Checkout dan Bayar?',
            html: "<div style='margin-bottom: 5px; font-weight: bold;'>" + nama_lengkap + " (" + no_rm + ")</div>Tagihan sebesar: <b>Rp " + total_bayar_teks + "</b>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, bayar!',
            cancelButtonText: 'Tidak Jadi',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: href,
                    dataType: 'json',
                    data: {
                        no_daftar: no_daftar,
                        no_rm: no_rm,
                        total_harga: total_harga,
                        total_bayar: total_bayar
                    },
                    beforeSend: function () {
                        setBtnLoading(btn, "Memproses Pembayaran");
                    },
                    success: function (data) {
                        if (data.s) {
                            successMsg('Berhasil Membayar a.n<br>' + nama_lengkap + ' (' + no_rm + ')')
                            $.pjax.reload({
                                container: "#pjax-rekapitulasi",
                                async: false,
                            })
                        } else {
                            errorMsg(data.m)
                            console.log(data.error);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        errorMsg('Terjadi Kesalahan, Mohon coba lagi yaaa.')
                    },
                    complete: function () {
                        resetBtnLoading(btn, html)
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {}
        })

    })
}