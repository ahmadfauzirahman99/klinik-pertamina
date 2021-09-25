/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
<<<<<<< HEAD
 * @Last Modified time: 2021-09-24 16:13:29
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
    //                 $(`#orderlabdetail-${lastIndex}-item_pemeriksaan`).select2('open')
    //             } else {
    //                 if ($(`#orderlabdetail-${lastIndex}-item_pemeriksaan`).val() == null || $(`#orderlabdetail-${lastIndex}-item_pemeriksaan`).val() == '')
    //                     $(`#orderlabdetail-${lastIndex}-item_pemeriksaan`).select2('open')
    //                 else
    //                     $('.add-item').click()
    //             }
    //             break;
    //         case 'p':
    //             $('#btn-print-berkas').click();
    //             break;
    //         case 'r':
    //             $(`item_pemeriksaan-no_rm`).select2('open')
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
=======
 * @Last Modified time: 2021-09-25 16:36:28
 */

const fungsi = _ => {

    // disable submit form lewat enter
    $('#form-tindakan').on('keyup keypress', function (e) {
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
        let keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })
<<<<<<< HEAD

=======
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
}

let onFocusSelect = data => {
    $(data).select()
}

let inputJumlahHargaJual = data => {
    $(data).trigger('change')
    let index = $(data).closest("tr").index()
<<<<<<< HEAD
    let jumlah = parseFloat($(`#orderlabdetail-${index}-jumlah`).val())
    let harga_tindakan = parseFloat($(`#orderlabdetail-${index}-harga_tindakan`).val())
    let subtotal = jumlah * harga_tindakan
    $(`#orderlabdetail-${index}-subtotal-disp`).val(subtotal).trigger('change')
=======
    let jumlah = parseFloat($(`#layanandetail-${index}-jumlah`).val())
    let harga_jual = parseFloat($(`#layanandetail-${index}-harga_jual`).val())
    let subtotal = jumlah * harga_jual
    $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger('change')
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
}

let onChangeSubtotal = _ => {
    let totalSubtotal = 0
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
        totalSubtotal = parseFloat($(this).find("input[name*='[subtotal]']").val()) + totalSubtotal
<<<<<<< HEAD
        // console.log(totalSubtotal)
    })
    $(`#orderlab-total_harga-disp`).val(totalSubtotal).trigger('change')
}

// let onClickSubtotal = (data) => {
//     let subtotalDiKlik = $(data).inputmask('unmaskedvalue')
//     let total_subsidi = $('item_pemeriksaan-total_dijamin-disp').inputmask('unmaskedvalue')
//     total_subsidi += subtotalDiKlik
//     $('item_pemeriksaan-total_dijamin-disp').val(total_subsidi).trigger('change')
// }

=======
    })
    $(`#layanan-total_harga-disp`).val(totalSubtotal).trigger('change')
}

>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
let enterNewRow = (data, key) => {
    let index = $(data).closest("tr").index()
    if (key === 13) {
        const banyakBaris = $(".dynamicform_wrapper .form-options-item").length
        if (banyakBaris === index + 1) {
            $('.add-item').click()
            $(data).trigger('change')
        } else {
<<<<<<< HEAD
            $(`#orderlabdetail-${index+1}-item_pemeriksaan`).select2('open')
=======
            $(`#layanandetail-${index+1}-id_tindakan`).select2('open')
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
            $(data).trigger('change')
        }
    }
}

<<<<<<< HEAD
let onChangeTotalHarga = _ => {
    onChangeDiskonPersen()
}

let onChangeDiskonPersen = _ => {
    let total_harga = parseFloat($('item_pemeriksaan-total_harga-disp').inputmask('unmaskedvalue'))
    // let diskon_persen = parseFloat($('item_pemeriksaan-diskon_persen-disp').inputmask('unmaskedvalue'))
    // let diskon_total = 0

    // diskon_total = diskon_persen * total_harga / 100
    // $('item_pemeriksaan-diskon_total-disp').val(diskon_total < 0 ? 0 : diskon_total).trigger('change')

    let total_bayar = total_harga
    $('item_pemeriksaan-total_bayar-disp').val(total_bayar < 0 ? 0 : total_bayar).trigger('change')

}

=======
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
hotkeys.filter = ({
    target
}) => {
    return true
    // console.log(target.tagName);
    // return target.tagName === 'INPUT' || target.tagName === 'DIV' || target.tagName === 'BODY';
    // return !(target.tagName === 'INPUT' && target.type !== 'radio') ;
}

<<<<<<< HEAD
hotkeys('r,ctrl+o,ctrl+i,ctrl+d,ctrl+s', function (event, handler) {
    event.preventDefault();
    switch (handler.key) {
        case 'r':
            $(`item_pemeriksaan-no_rm`).select2('open')
            break;
        case 'ctrl+o':
            let index = $(".dynamicform_wrapper .form-options-item").length - 1
            $(`#orderlabdetail-${index}-item_pemeriksaan`).select2('open')
            return false;
            break;
        case 'ctrl+i':
            $('.add-item').click()
            return false;
            break;
        case 'ctrl+d':
            $('item_pemeriksaan-diskon_persen-disp').focus()
            return false;
            break;
        case 'ctrl+s':
            $('.btn-simpan-form-obat').click()
=======
hotkeys('alt+r,alt+o,alt+i,alt+d,alt+s', function (event, handler) {
    event.preventDefault();
    switch (handler.key) {
        case 'alt+r':
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
        case 'alt+s':
            $('.btn-simpan-form-tindakan').click()
>>>>>>> 96fd5c599e0e49224742f4c8520e7aebcdb83b6c
            return false;
            break;
        default:
            alert(event);
    }
});