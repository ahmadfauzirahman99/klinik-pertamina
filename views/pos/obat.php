<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-15 16:21:01 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-19 12:32:37
 */

use app\components\DynamicFormWidget;
use app\components\number\KyNumber;
use app\models\Dokter;
use app\models\Poli;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

$this->title = 'Point Of Sales (POS)';


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
        padding: 1px 2px 0px 2px;
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

                    <?php $form = ActiveForm::begin([
                        'id' => 'form-obat',
                        'layout' => 'horizontal',
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
                            <?= $form->field($model, 'no_daftar')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'no_rm')->textInput(['maxlength' => true]) ?>
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

                            <?= $form->field($model, 'id_poli')->widget(Select2::classname(), [
                                'data' => Poli::find()->select2(),
                                'pluginOptions' => [
                                    'allowClear' => false,
                                    // 'placeholder' => 'Pilih...'
                                ],
                            ])->label('Poli') ?>

                            <?= $form->field($model, 'id_dokter')->widget(Select2::classname(), [
                                'data' => Dokter::find()->select2(),
                                'pluginOptions' => [
                                    'allowClear' => false,
                                    // 'placeholder' => 'Pilih...'
                                ],
                            ])->label('Dokter') ?>

                        </div>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-sm-12">

                            <?php DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper',
                                'widgetBody' => '.form-options-body',
                                'widgetItem' => '.form-options-item',
                                'min' => 1,
                                'insertButton' => '.add-item',
                                'deleteButton' => '.delete-item',
                                'model' => $modelDetail[0],
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
                                        <th style="color: white; font-size: 11px; width: 25%">Barang</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Keterangan</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Dosis</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Jumlah</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Harga Jual</th>
                                        <th style="color: white; font-size: 11px; width: 15%">Subtotal</th>
                                        <th style="color: white; font-size: 11px; width: 1%"></th>
                                    </tr>
                                </thead>
                                <tbody class="form-options-body">
                                    <?php foreach ($modelDetail as $i => $modelDetail) : ?>
                                        <tr class="form-options-item">

                                            <?php
                                            // necessary for update action.
                                            if (!$modelDetail->isNewRecord) {
                                                echo Html::activeHiddenInput($modelDetail, "[{$i}]id_resep_detail");
                                            }
                                            ?>
                                            <td style="text-align: center;">
                                                <span class="nomor">
                                                    <?= ($i + 1) ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?php
                                                $url = Url::to(['api-internal/cari-obat']);
                                                echo $form->field($modelDetail, "[{$i}]id_barang", [
                                                    // <span class="label-detail required">Barang</span>
                                                    'template' => '
                                            <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(Select2::classname(), [
                                                    'options' => [
                                                        // 'id' => '',
                                                        'class' => 'dynamic-select2',
                                                        'placeholder' => 'Ketik Nama Barang...',
                                                    ],
                                                    'initValueText' => $modelDetail->barang->nama_barang ?? null,
                                                    'pluginOptions' => [
                                                        // 'dropdownAutoWidth' => true,
                                                        'allowClear' => false,
                                                        'minimumInputLength' => 3,
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
                                                            id_depo:$("#penjualan-id_depo").val()
                                                        }; 
                                                    }')
                                                        ],
                                                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                        'templateResult' => new JsExpression('function(data) { 
                                                    let warnaInfoStok = null
                                                    let teksStok = null
                                                    if(data.stok_depo == 0){
                                                        warnaInfoStok = "maroon"
                                                        teksStok = "Kosong"
                                                    }else {
                                                        warnaInfoStok = "teal"
                                                        teksStok = "Ada"
                                                    }
                                                    return (data.loading) ?
                                                        data.text :                                                        
                                                        `${data.text} <span class="float-right"><button class="btn btn-xs bg-${warnaInfoStok}" style="width:85px; padding-top: 0px !important; padding-bottom: 0px !important;">${teksStok}</button></span>` ;     
                                                }'),
                                                        'templateSelection' => new JsExpression('function (data) { return data.text; }'),
                                                    ],
                                                    'pluginEvents' => [
                                                        "select2:select" => new JsExpression('function(e) { 
                                                            let index = $(this).closest("tr").index()
                                                            let barangDipilih = e.params.data

                                                            // cek item sudah dipilih atau belum
                                                            let uda_dipilih = 0
                                                            $(\'.dynamicform_wrapper .form-options-item\').each(function (e) {
                                                                let id_barang_sudah_dipilih = $(this).find("select[name*=\'[id_barang]\']").val()
                                                                if (id_barang_sudah_dipilih == barangDipilih.id) {
                                                                    uda_dipilih++
                                                                    if (uda_dipilih == 2) {
                                                                        return false
                                                                    }
                                                                }
                                                            })

                                                            if (uda_dipilih == 2) {
                                                                $(`#penjualandetail-${index}-id_barang`).val(null).trigger("change")
                                                                $(`#penjualandetail-${index}-id_barang`).select2("open")
                                                                toastr.error(\'Upps,, Item sudah dipilih ya Bund. Coba yang lain ya\')
                                                            } else {
                                                                $($(this).closest("tr")).find(".div-fornas").html(barangDipilih.fornas)

                                                                $(`#penjualandetail-${index}-is_fornas`).prop(`checked`, barangDipilih.is_fornas)

                                                                $(`#penjualandetail-${index}-stok_saat_jual-disp`).val(barangDipilih.stok_depo).trigger("change")
                                                                $(`#penjualandetail-${index}-harga_satuan-disp`).val(barangDipilih.harga_jual).trigger("change")
                                                                let subtotal = $(`#penjualandetail-${index}-jumlah`).val() * barangDipilih.harga_jual
                                                                $(`#penjualandetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                                                                $(`#penjualandetail-${index}-jumlah-disp`).focus()
                                                            }
                                                        
                                                        }'),
                                                        // "select2:unselect" => new JsExpression('function() { 
                                                        // }'),
                                                        // "change" => new JsExpression('function(data) { 
                                                        // }'),                                                
                                                        // "select2:opening" => "function() { log('select2:opening'); }",
                                                        // "select2:open" => "function() { log('open'); }",
                                                        // "select2:closing" => "function() { log('close'); }",
                                                        // "select2:close" => "function() { log('close'); }",
                                                        // "select2:selecting" => "function() { log('selecting'); }",
                                                        // "select2:unselecting" => "function() { log('unselecting'); }",
                                                    ]
                                                ])->label(false);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]keterangan", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->textInput([
                                                    'class' => 'form-control form-control-sm signa-typeahead det_signa',
                                                    'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                    'onfocus' => 'onFocusSelect(this)',
                                                ])->label(false);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]dosis", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->textInput([
                                                    'class' => 'form-control form-control-sm signa-typeahead det_signa',
                                                    'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                    'onfocus' => 'onFocusSelect(this)',
                                                ])->label(false);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]jumlah", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(KyNumber::className(), ['displayOptions' => [
                                                    'class' => 'form-control form-control-sm det_jumlah',
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]harga_jual", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(KyNumber::className(), ['displayOptions' => [
                                                    'class' => 'form-control form-control-sm det_harga_jual',
                                                    'readonly' => true,
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]subtotal", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(KyNumber::className(), ['displayOptions' => [
                                                    'class' => 'form-control form-control-sm det_subtotal',
                                                    'readonly' => true,
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="delete-item btn btn-xs" title="Hapus Item">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: center;" colspan="7">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="add-item btn btn-xs" title="Tambah Item">
                                                <i class="fas fa-plus text-info"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <?php DynamicFormWidget::end(); ?>


                        </div>
                    </div>

                    <div class="tabel-total" style="margin-top: 25px;">
                        <table class="table">
                            <tbody class="tbody-total">
                                <tr>
                                    <td><label>Total Harga :</label></td>
                                    <td style="width: 35%;">
                                        <?php
                                        echo $form->field($model, 'total_harga', [])->widget(KyNumber::className(), ['displayOptions' => [
                                            'style' => 'font-weight: bold;',
                                            'readonly' => true,
                                            // 'onchange' => 'onChangeTotalBiayaSubsidi()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-style: italic;"><label>Diskon (%) :</label></td>
                                    <td style="width: 35%;">
                                        <?php
                                        echo $form->field($model, 'diskon_persen', [])->widget(KyNumber::className(), ['displayOptions' => [
                                            'style' => 'font-weight: bold;',
                                            'readonly' => false,
                                            // 'onchange' => 'onChangeTotalBiayaSubsidi()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-style: italic;"><label>Diskon Total :</label></td>
                                    <td style="width: 35%;">
                                        <?php
                                        echo $form->field($model, 'diskon_total', [])->widget(KyNumber::className(), ['displayOptions' => [
                                            'style' => 'font-weight: bold;',
                                            'readonly' => true,
                                            // 'onchange' => 'onChangeTotalBiayaSubsidi()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Total Bayar :</label></td>
                                    <td style="width: 35%;">
                                        <?php
                                        echo $form->field($model, 'total_bayar', [])->widget(KyNumber::className(), ['displayOptions' => [
                                            'style' => 'font-weight: bold;',
                                            'readonly' => true,
                                            // 'onchange' => 'onChangeTotalBiayaSubsidi()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group float-right">
                        <?= Html::submitButton('[ CTRL+S ] Simpan', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
$this->registerJs($this->render('_obat.js'), View::POS_END);
$this->registerJs($this->render('_obat_ready.js'));
