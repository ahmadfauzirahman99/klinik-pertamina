/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-19 10:54:02
 */

// fungsi tombol tambah paket
const tambahPaketPenjualan = _ => {
    let id_paket = $('#penjualan-paket_penjualan').val()

    // tarik paket dari server
    $.ajax({
        method: 'GET',
        url: '/api-internal/penjualan-ambil-paket',
        dataType: 'json',
        data: {
            id_paket: id_paket,
            id_depo: $('#penjualan-id_depo').val()
        },
        beforeSend: function () {
            $('#btn-tambah-paket').prop('disabled', true)
            $('#load-paket').show()
        },
        success: function (data) {
            if (data) {
                const jumlahItem = $(".dynamicform_wrapper .form-options-item").length

                data.forEach(element => {
                    // cek item sudah dipilih atau belum
                    let uda_dipilih = false
                    $('.dynamicform_wrapper .form-options-item').each(function (e) {
                        let id_barang_sudah_dipilih = $(this).find("select[name*='[id_barang]']").val()
                        if (id_barang_sudah_dipilih == element.id_barang) {
                            uda_dipilih = true
                            return false
                        }
                        console.log(id_barang_sudah_dipilih);
                    })

                    if (uda_dipilih) // klu sudah dipilih, lewatkan (tidak masuk ke list penjualan)
                        return;

                    // console.log(element);
                    $('.add-item').click()
                    let index_last_tr = $('.form-options-body tr:last').index()

                    // create the option and append to Select2
                    let select2Copied = $(`#penjualandetail-${index_last_tr}-id_barang`)
                    var option = new Option(element.nama_barang, element.id_barang, true, true)
                    select2Copied.append(option).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-is_fornas`).prop(`checked`, element.is_fornas)
                    $(`#penjualandetail-${index_last_tr}-stok_saat_jual-disp`).val(element.stok_saat_jual).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-jumlah-disp`).val(element.jumlah).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-signa`).val(element.signa).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-catatan`).val(element.catatan).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-harga_satuan-disp`).val(element.harga_satuan).trigger('change')
                    $(`#penjualandetail-${index_last_tr}-subtotal-disp`).val(element.subtotal).trigger('change')
                });
                if (jumlahItem == 1) {
                    $('.form-options-body tr').eq(0).find('.delete-item').click()
                }
                toastr.success('Berhasil menambahkan Paket Penjualan.')
            } else {
                toastr.error('Upps,, ada yang gagal. Coba lagi ya')
                console.log(data.error);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            toastr.error('Terjadi Kesalahan, Mohon coba lagi yaaa.')
        },
        complete: function () {
            $('#btn-tambah-paket').prop('disabled', false)
            $('#load-paket').hide()
        }
    })
}

const fungsi = _ => {

    // validasiJumlah()

    // hotkeys('i,o,p,r,shift+s,s,u', function (event, handler) {
    //     let jumlahItem = $(".dynamicform_wrapper .form-options-item").length
    //     let lastIndex = jumlahItem - 1
    //     switch (handler.key) {
    //         case 'i':
    //             $('#btn-print-invoice').click();
    //             break;
    //         case 'o':
    //             if (jumlahItem == 1) {
    //                 $(`#penjualandetail-${lastIndex}-id_barang`).select2('open')
    //             } else {
    //                 if ($(`#penjualandetail-${lastIndex}-id_barang`).val() == null || $(`#penjualandetail-${lastIndex}-id_barang`).val() == '')
    //                     $(`#penjualandetail-${lastIndex}-id_barang`).select2('open')
    //                 else
    //                     $('.add-item').click()
    //             }
    //             break;
    //         case 'p':
    //             $('#btn-print-berkas').click();
    //             break;
    //         case 'r':
    //             $(`#penjualan-no_rm`).select2('open')
    //             break;
    //         case 'shift+s':
    //             $('#btn-simpan-penjualan').click();
    //             break;
    //         case 's':
    //             $('#btn-simpan-penjualan').click();
    //             break;
    //         case 'u':
    //             $('#btn-update-penjualan')[0].click();
    //             break;
    //         default:
    //             alert(event);
    //     }
    // })

    // disable submit form lewat enter
    $('#form-penjualan').on('keyup keypress', function (e) {
        let keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })

    $('.signa-typeahead').typeahead({
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
    $('.catatan-typeahead').typeahead({
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

}

let onFocusSelect = data => {
    $(data).select()
}

let inputJumlahHargaJual = data => {
    $(data).trigger('change')
    let index = $(data).closest("tr").index()
    let jumlah = parseFloat($(`#penjualandetail-${index}-jumlah`).val())
    let harga_jual = parseFloat($(`#penjualandetail-${index}-harga_satuan`).val())
    let subtotal = jumlah * harga_jual
    $(`#penjualandetail-${index}-subtotal-disp`).val(subtotal).trigger('change')
}

let onChangeSubtotal = _ => {
    let totalSubtotal = 0
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
        totalSubtotal = parseFloat($(this).find("input[name*='[subtotal]']").val()) + totalSubtotal
    })
    $(`#penjualan-total_penjualan-disp`).val(totalSubtotal).trigger('change')
}

let onClickSubtotal = (data) => {
    let subtotalDiKlik = $(data).inputmask('unmaskedvalue')
    let total_subsidi = $('#penjualan-total_dijamin-disp').inputmask('unmaskedvalue')
    total_subsidi += subtotalDiKlik
    $('#penjualan-total_dijamin-disp').val(total_subsidi).trigger('change')
}

let enterNewRow = (data, key) => {
    let index = $(data).closest("tr").index()
    if (key === 13) {
        const banyakBaris = $(".dynamicform_wrapper .form-options-item").length
        if (banyakBaris === index + 1) {
            $('.add-item').click()
            $(data).trigger('change')
        } else {
            $(`#penjualandetail-${index+1}-id_barang`).select2('open')
            $(data).trigger('change')
        }
    }
}

let onChangeTotalBiayaSubsidi = _ => {
    let total_biaya = parseFloat($('#penjualan-total_penjualan-disp').inputmask('unmaskedvalue'))
    let total_subsidi = parseFloat($('#penjualan-total_dijamin-disp').inputmask('unmaskedvalue'))

    let total_pembayan = total_biaya - total_subsidi
    $('#penjualan-total_dibayar-disp').val(total_pembayan < 0 ? 0 : total_pembayan).trigger('change')
}