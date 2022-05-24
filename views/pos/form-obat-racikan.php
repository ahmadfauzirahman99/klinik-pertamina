<?php

use app\components\number\KyNumber;
use dickyermawan\base\KyDynamicForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'Form Obat Racikan';

?>
<div>

    <style>
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

        .select2-container--open .select2-dropdown--below {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            width: 400px !important;
            min-width: 376.4px;
            position: relative;
        }
    </style>
</div>
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

                    <?php $form = ActiveForm::begin([
                        'id' => 'form-obat',
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


                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'no_daftar')->textInput([
                                'maxlength' => true,
                                'readonly' => true,
                            ]) ?>

                            <?php
                            $url = Url::to(['api-internal/cari-rm']);

                            echo $form->field($model, "no_rm")->widget(Select2::classname(), [
                                'options' => [
                                    'placeholder' => 'Ketik No. RM / Nama Pasien...',
                                ],
                                'initValueText' => !$model->isNewRecord ? $model->no_rm : null,
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
                                        console.log(pasien)
                                        window.open(baseUrl + "/pos/obat" + "?reg=" + pasien.no_daftar + "&rm=" + pasien.no_rm, \'_self\');
                                    
                                        // let pasien = e.params.data
                                        //let tglLahir = new Date(pasien.TGL_LAHIR)

                                        // $(`#resep-no_daftar`).val(pasien.no_daftar).trigger("change")
                                        // $(`#resep-nama_pasien`).val(pasien.nama).trigger("change")
                                        // $(`#resep-id_poli`).val(pasien.id_poli).trigger("change")

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

                            <?= $form->field($model, 'nama_pasien')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row field-resep-id_poli required">
                                <div class="col-sm-4">
                                    <label class="col-form-label-sm" for="resep-tanggal">Tanggal Resep</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            echo $form->field($model, 'tanggal', [
                                                'wrapperOptions' => ['style' => 'margin-left: 0px;'],
                                            ])->widget(DatePicker::classname(), [
                                                'options' => ['placeholder' => 'Pilih...'],
                                                'removeButton' => false,
                                                'pluginOptions' => [
                                                    'layout' => '{input}{error}',
                                                    'todayHighlight' => true,
                                                    'autoclose' => true,
                                                    'format' => 'dd-mm-yyyy'
                                                ]
                                            ])->label(false)
                                            ?>

                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($model, 'jam')->widget(TimePicker::classname(), [
                                                'pluginOptions' => [
                                                    'showSeconds' => true,
                                                    'showMeridian' => false,
                                                    'minuteStep' => 5,
                                                    'secondStep' => 5,
                                                ]
                                            ]) ?>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <?php
                            echo $form->field($model, 'total_tuslah', [])->widget(KyNumber::className(), ['displayOptions' => [
                                'style' => 'font-weight: bold;',
                                'readonly' => false,
                                'placeholder' => 'Harga Racikan Obat'
                            ]]);
                            ?>

                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Resep Obat Racikan</strong> Buat Resep Racikan
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <hr>

                        <div class="row" style="margin-top: 15px;">
                            <div class="col-sm-12">

                                <?php KyDynamicForm::begin([
                                    'widgetContainer' => 'dynamicform_wrapper1',
                                    'widgetBody' => '.form-options-body-racikan',
                                    'widgetItem' => '.form-options-item-racikan',
                                    'min' => 1,
                                    'insertButton' => '.add-item-racikan',
                                    'deleteButton' => '.delete-item-racikan',
                                    'model' => $modelRacikan[0],
                                    'formId' => 'form-obat',
                                    'formFields' => [
                                        'id_barang',
                                        'dosis',
                                        'keterangan',
                                        'harga_jual',
                                        'jumlah',
                                        'subtotal',
                                    ],
                                ]); ?>

                                <table class="table-list-item table table-sm table-bordered table-hover" style="width: 100%;">
                                    <thead class="bg-teal" style="text-align: center;">
                                        <tr class="bg-danger">
                                            <th style="color: white; font-size: 11px; width: 3%">#</th>
                                            <!-- <th style="color: white; font-size: 11px; width: 25%">Barang</th> -->
                                            <th style="color: white; font-size: 11px; width: 20%">Keterangan</th>
                                            <th style="color: white; font-size: 11px; width: 80%">Racikan</th>
                                            <!-- <th style="color: white; font-size: 11px; width: 14%">Jumlah</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Harga Jual</th>
                                        <th style="color: white; font-size: 11px; width: 15%">Subtotal</th> -->
                                            <th style="color: white; font-size: 11px; width: 14%">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="form-options-body-racikan">
                                        <?php foreach ($modelRacikan as $i => $modelRacikan) : ?>
                                            <tr class="form-options-item-racikan">

                                                <?php
                                                // necessary for update action.
                                                if (!$modelRacikan->isNewRecord) {
                                                    echo Html::activeHiddenInput($modelRacikan, "[{$i}]id_racikan");
                                                }
                                                ?>
                                                <td style="text-align: center;">
                                                    <span class="nomor-racikan">
                                                        <?= ($i + 1) ?>
                                                    </span>
                                                </td>

                                                <td style="padding-top: 3.5px;">
                                                    <?php
                                                    echo $form->field($modelRacikan, "[{$i}]keterangan", [
                                                        // <span class="label-detail">Jlh. Diterima</span>
                                                        'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                    ])->textInput([
                                                        'class' => 'form-control form-control-md signa-typeahead det_signa',
                                                        'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                        'onfocus' => 'onFocusSelect(this)',
                                                        'placeholder' => 'Nama Racikan'
                                                    ])->label(false);
                                                    ?>
Total Bayar :

                                                    <?php
                                                    echo $form->field($modelRacikan, "[{$i}]total_bayar", [
                                                        // <span class="label-detail">Jlh. Diterima</span>
                                                        'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                    ])->textInput([
                                                        'class' => 'form-control form-control-md signa-typeahead det_signa total_bayar_nya',
                                                        'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                        'onfocus' => 'onFocusSelect(this)',
                                                        'placeholder' => 'Tital bayar'
                                                    ])->label(false);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $this->render('_obat_racikan', [
                                                        'form' => $form,
                                                        'indexRacikan' => $i,

                                                        'modelRacikanDetail' => $modelRacikanDetail[$i],

                                                    ]) ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="delete-item-racikan btn btn-xs" title="Hapus Item">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="text-align: center;" colspan="3">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="add-item-racikan btn btn-xs" title="Tambah Item">
                                                    <i class="fas fa-plus text-info"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <?php KyDynamicForm::end(); ?>


                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="tabel-total" style="margin-top: 25px;">
                        <table class="table">

                            <tbody class="tbody-total">
                                <tr>
                                    <td><label>TOTAL BIAYA RACIKAN : </label></td>
                                    <td style="width: 35%;">
                                        <?php
                                        echo $form->field($model, 'total_biaya_racikan', [])->widget(KyNumber::className(), ['displayOptions' => [
                                            'style' => 'font-weight: bold;',
                                            'readonly' => true,
                                            'onchange' => 'onChangeTotalHarga()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="form-group float-right">
                        <?= Html::submitButton('[ ALT+S ] Simpan', ['class' => 'btn btn-success btn-simpan-form-obat']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>