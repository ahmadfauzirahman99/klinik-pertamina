/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 11:46:03
 */



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
    //                 $(`#layanandetail-${lastIndex}-id_tindakan`).select2('open')
    //             } else {
    //                 if ($(`#layanandetail-${lastIndex}-id_tindakan`).val() == null || $(`#layanandetail-${lastIndex}-id_tindakan`).val() == '')
    //                     $(`#layanandetail-${lastIndex}-id_tindakan`).select2('open')
    //                 else
    //                     $('.add-item').click()
    //             }
    //             break;
    //         case 'p':
    //             $('#btn-print-berkas').click();
    //             break;
    //         case 'r':
    //             $(`id_tindakan-no_rm`).select2('open')
    //             break;
    //         case 'shift+s':
    //             $('#btn-simpan-orderlab').click();
    //             break;
    //         case 's':
    //             $('#btn-simpan-orderlab').click();
    //             break;
    //         case 'u':
    //             $('#btn-update-orderlab')[0].click();
    //             break;
    //         default:
    //             alert(event);
    //     }
    // })

    // disable submit form lewat enter
    $('#form-obat').on('keyup keypress', function (e) {
        let keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })
}

let onFocusSelect = data => {
    $(data).select()
}

let inputJumlahHargaJual = data => {
    $(data).trigger('change')
    let index = $(data).closest("tr").index()
    let jumlah = parseFloat($(`#layanandetail-${index}-jumlah`).val())
    let harga_jual = parseFloat($(`#layanandetail-${index}-harga_jual`).val())
    let subtotal = jumlah * harga_jual
    $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger('change')
}

let onChangeSubtotal = _ => {
    let totalSubtotal = 0
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
        totalSubtotal = parseFloat($(this).find("input[name*='[subtotal]']").val()) + totalSubtotal
        // console.log(totalSubtotal)
    })
    // $(`#orderlab-total_harga-disp`).val(totalSubtotal).trigger('change')
}

// let onClickSubtotal = (data) => {
//     let subtotalDiKlik = $(data).inputmask('unmaskedvalue')
//     let total_subsidi = $('id_tindakan-total_dijamin-disp').inputmask('unmaskedvalue')
//     total_subsidi += subtotalDiKlik
//     $('id_tindakan-total_dijamin-disp').val(total_subsidi).trigger('change')
// }

let enterNewRow = (data, key) => {
    let index = $(data).closest("tr").index()
    if (key === 13) {
        const banyakBaris = $(".dynamicform_wrapper .form-options-item").length
        if (banyakBaris === index + 1) {
            $('.add-item').click()
            $(data).trigger('change')
        } else {
            $(`#layanandetail-${index+1}-id_tindakan`).select2('open')
            $(data).trigger('change')
        }
    }
}

// let onChangeTotalHarga = _ => {
//     onChangeDiskonPersen()
// }

// let onChangeDiskonPersen = _ => {
//     let total_harga = parseFloat($('id_tindakan-total_harga-disp').inputmask('unmaskedvalue'))
//     // let diskon_persen = parseFloat($('id_tindakan-diskon_persen-disp').inputmask('unmaskedvalue'))
//     // let diskon_total = 0

//     // diskon_total = diskon_persen * total_harga / 100
//     // $('id_tindakan-diskon_total-disp').val(diskon_total < 0 ? 0 : diskon_total).trigger('change')

//     let total_bayar = total_harga
//     $('id_tindakan-total_bayar-disp').val(total_bayar < 0 ? 0 : total_bayar).trigger('change')

// }

hotkeys.filter = ({
    target
}) => {
    return true
    // console.log(target.tagName);
    // return target.tagName === 'INPUT' || target.tagName === 'DIV' || target.tagName === 'BODY';
    // return !(target.tagName === 'INPUT' && target.type !== 'radio') ;
}

hotkeys('r,alt+o,alt+i,alt+d,alt+s', function (event, handler) {
    event.preventDefault();
    switch (handler.key) {
        case 'r':
            $(`#layanan-no_rm`).select2('open')
            break;
        case 'alt+o':
            let index = $(".dynamicform_wrapper .form-options-item").length - 1
            $(`#layanandetail-${index}-id_tindakan`).select2('open')
            return false;
            break;
        case 'alt+i':
            $('.add-item').click()
            return false;
            break;
        // case 'alt+d':
        //     $('id_tindakan-diskon_persen-disp').focus()
        //     return false;
        //     break;
        case 'alt+s':
            $('.btn-simpan-form-tindakan').click()
            return false;
            break;
        default:
            alert(event);
    }
});