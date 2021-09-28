<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-24 17:38:03 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 11:20:08
 */

use app\components\DynamicFormWidget;
use app\components\number\KyNumber;
use app\models\DebiturDetail;
use app\models\Dokter;
use app\models\Layanan;
use app\models\Poli;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;


$this->title = 'Point Of Service (POS)';


?>

<style>
    form .col-form-label-sm {
        font-size: 10.5px;
    }

    form .col-form-label-sm,
    form .form-group {
        margin-bottom: 0.15rem;
    }

    .form-options-item td {
        padding: 2px 2px 0px 2px;
    }

    .tabel-total table td {
        padding: 1px !important;
    }

    .tabel-total table td .form-group {
        margin-bottom: 0px !important;
    }

    .tabel-total table td {
        text-align: right;
    }

    .tabel-total table td label {
        margin: 5px 5px 5px 5px !important;
        font-weight: bold;
        font-size: 0.8em;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs">
                        <?= $this->render('form-wizard', ['model' => '']) ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" style="padding-right: 2px;">
                            <div class="card" style="border: solid 1px #c7c9cb;">
                                <div class="card-header">
                                    <i class="fas fa-user-injured fa-md"></i> &nbsp; Informasi Pasien
                                </div>
                                <div class="card-body">
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'form-checkout',
                                        'layout' => 'horizontal',
                                        // 'action' => ['/pos/obat'],
                                        'fieldConfig' => [
                                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                            'horizontalCssClasses' => [
                                                'label' => 'col-sm-4 col-form-label-sm',
                                                'wrapper' => 'col-sm-8',
                                                'error' => '',
                                                'hint' => '',
                                            ],
                                        ],
                                    ]); ?>

                                    <?php
                                    $url = Url::to(['api-internal/cari-rm']);

                                    echo $form->field($model, "no_rm")->widget(Select2::classname(), [
                                        
                                        'options' => [
                                            'placeholder' => 'Ketik No. RM / Nama Pasien...',
                                        ],
                                        'initValueText' => $model->getPasien($model->no_rm)->no_rekam_medik ?? null,
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                            'minimumInputLength' => 3,
                                            'dropdownAutoWidth' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression('function () { 
                                            return "Menunggu hasil..."; 
                                        }'),
                                                'inputTooShort' => new JsExpression('function () {
                                            return "Minimal 3 karakter...";
                                        }'),
                                                'searching' => new JsExpression('function() {
                                            return "Mencari...";
                                        }'),
                                            ],
                                            'ajax' => [
                                                'url' => $url,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { 
                                            return {
                                                q:params.term, 
                                                tanggal:$("#resep-tanggal").val()
                                            }; 
                                        }'),
                                                'delay' => 250,
                                                'cache' => true,
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function(data) { 
                                        let warnaInfoStok = data.stok == 0 ? "danger" : "success"
                                        return (data.loading) ?
                                        data.text :
                                        `<div class="row"> 
                                            <div class="col-sm-6">
                                                <strong>${data.nama}</strong> <br>
                                                ${data.no_rm}
                                            </div>
                                            <div class="col-sm-2">
                                                ${data.nama_poli}
                                            </div>
                                            <div class="col-sm-4">
                                                ${data.tgl_masuk}
                                            </div>
                                        </div>`
                                    }'),
                                            'templateSelection' => new JsExpression('function (data) { return data.no_rm ? data.no_rm : data.text; }'),
                                        ],
                                        'pluginEvents' => [
                                            "select2:select" => new JsExpression('function(e) { 
                                        let pasien = e.params.data
                                        //let tglLahir = new Date(pasien.TGL_LAHIR)

                                        $(`#resep-no_daftar`).val(pasien.no_daftar).trigger("change")
                                        $(`#resep-nama_pasien`).val(pasien.nama).trigger("change")
                                        $(`#resep-id_poli`).val(pasien.id_poli).trigger("change")

                                        // $(`#penjualan-nama_pasien`).val(pasien.px_name).trigger("change")
                                        // $(`#penjualan-alamat_pasien`).val(pasien.px_address).trigger("change")
                                        // $(`#penjualan-jenis_kelamin`).val(pasien.px_sex).trigger("change")
                                        
                                        // $(`#penjualan-no_sep`).val(pasien.pxsurety_no).trigger("change")

                                        // if(pasien.id != "00000000") {
                                        //     $(`#penjualan-tgl_lahir`).val(formatDateIndo(pasien.TGL_LAHIR)).trigger("change")
                                        //     $("#penjualan-umur").val(pasien.umur).trigger("change")
                                        //     $(`#penjualan-id_unit`).html(new Option(pasien.unit_name, pasien.unit_id_pelayanan, true, true)).trigger("change")
                                        //     $(`#penjualan-id_dokter`).html(new Option(pasien.par_name, pasien.par_id, true, true)).trigger("change")
                                        //     $("#penjualan-nama_dokter").val(pasien.par_name)
                                        //     $(`#penjualan-id_penjamin`).html(new Option(pasien.surety_name, pasien.surety_id, true, true)).trigger("change")
                                        // }
                                        
                                        // if(pasien.surety_id != 9999 || pasien.surety_id != 0037)
                                        //     $(`#penjualan-tipe_pembayaran`).val(0).trigger("change")

                                        // if(pasien.id == "00000000") {
                                        //     $(`#penjualan-id_penjamin_lama`).html(new Option("Umum", 9999, true, true)).trigger("change")
                                        //     $(`#penjualan-nama_pasien`).focus()
                                        //     $(`#penjualan-tipe_pembayaran`).val(1).trigger("change")
                                        // }

                                    }'),
                                        ]
                                    ]);
                                    ?>

                                    <?= $form->field($pendaftaran, 'id_pendaftaran')->textInput([
                                        'maxlength' => true,
                                        'readonly' => true,
                                    ]) ?>

                                    <?= $form->field($pendaftaran, 'tgl_masuk')->textInput([
                                        'maxlength' => true,
                                        'readonly' => true,
                                    ]) ?>

                                    <?= $form->field($pendaftaran, 'id_cara_bayar')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(DebiturDetail::find()->all(), 'id_debitur_kode', 'nama'),
                                        'options' => ['placeholder' => 'Cara Bayar'],
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ]); ?>

                                    <hr>

                                    <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7" style="padding-left: 2px;">
                            <div class="card" style="border: solid 1px #c7c9cb;">
                                <div class="card-header">
                                    <i class="fas fa-file-invoice-dollar fa-md"></i> &nbsp; Biaya
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>