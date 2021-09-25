/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-24 14:48:27 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-25 16:36:28
 */

const fungsi = _ => {

    // disable submit form lewat enter
    $('#form-tindakan').on('keyup keypress', function (e) {
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
    })
    $(`#layanan-total_harga-disp`).val(totalSubtotal).trigger('change')
}

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

hotkeys.filter = ({
    target
}) => {
    return true
    // console.log(target.tagName);
    // return target.tagName === 'INPUT' || target.tagName === 'DIV' || target.tagName === 'BODY';
    // return !(target.tagName === 'INPUT' && target.type !== 'radio') ;
}

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
            return false;
            break;
        default:
            alert(event);
    }
});