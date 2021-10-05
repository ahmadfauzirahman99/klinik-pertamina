<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-24 17:38:03 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-10-05 09:13:48
 */

use app\models\Dokter;
use app\models\Layanan;
use app\models\Poli;
use dickyermawan\base\KyDynamicForm;
use dickyermawan\base\KyNumber;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
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

                    <?php $form = ActiveForm::begin([
                        'id' => 'form-tindakan',
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
                            <?= $form->field($model, 'registrasi_kode')->textInput([
                                'maxlength' => true,
                                'readonly' => true,
                            ])->label('No. Daftar') ?>

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
                                                tanggal:$("#layanan-tanggal").val()
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
                                        window.open(baseUrl + "/pos/tindakan" + "?reg=" + pasien.no_daftar + "&rm=" + pasien.no_rm, \'_self\');
                                    
                                        // let pasien = e.params.data
                                        //let tglLahir = new Date(pasien.TGL_LAHIR)

                                        // $(`#layanan-registrasi_kode`).val(pasien.no_daftar).trigger("change")
                                        // $(`#layanan-nama_pasien`).val(pasien.nama).trigger("change")
                                        // $(`#layanan-unit_tujuan_kode`).val(pasien.id_poli).trigger("change")
                                    }'),
                                ]
                            ]);
                            ?>

                            <?= $form->field($model, 'nama_pasien')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $form->field($model, 'tgl_masuk', [
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
                            ])
                            ?>

                            <?= $form->field($model, 'unit_tujuan_kode')->widget(Select2::classname(), [
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

                            <?php KyDynamicForm::begin([
                                'widgetContainer' => 'dynamicform_wrapper',
                                'widgetBody' => '.form-options-body',
                                'widgetItem' => '.form-options-item',
                                'min' => 1,
                                'insertButton' => '.add-item',
                                'deleteButton' => '.delete-item',
                                'model' => $modelDetail[0],
                                'formId' => 'form-tindakan',
                                'formFields' => [
                                    'id_layanan',
                                    'id_tindakan',
                                    'keterangan',
                                    'harga_jual',
                                    'jumlah',
                                    'subtotal',
                                    'status',
                                ],
                            ]); ?>

                            <table class="table-list-item table table-sm table-bordered table-hover" style="width: 100%;">
                                <thead class="bg-teal" style="text-align: center;">
                                    <tr class="bg-danger">
                                        <th style="color: white; font-size: 11px; width: 3%">#</th>
                                        <th style="color: white; font-size: 11px; width: 36%">Tindakan</th>
                                        <th style="color: white; font-size: 11px; width: 12%">Jenis</th>
                                        <th style="color: white; font-size: 11px; width: 12%">Keterangan</th>
                                        <th style="color: white; font-size: 11px; width: 12%">Jumlah</th>
                                        <th style="color: white; font-size: 11px; width: 12%">Harga Jual</th>
                                        <th style="color: white; font-size: 11px; width: 12%">Subtotal</th>
                                        <th style="color: white; font-size: 11px; width: 1%"></th>
                                    </tr>
                                </thead>
                                <tbody class="form-options-body">
                                    <?php foreach ($modelDetail as $i => $modelDetail) : ?>
                                        <tr class="form-options-item">

                                            <?php
                                            // necessary for update action.
                                            if (!$modelDetail->isNewRecord) {
                                                echo Html::activeHiddenInput($modelDetail, "[{$i}]id_layanan_detail");
                                            }
                                            ?>
                                            <td style="text-align: center;">
                                                <span class="nomor">
                                                    <?= ($i + 1) ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?php
                                                $url = Url::to(['api-internal/cari-tindakan']);
                                                echo $form->field($modelDetail, "[{$i}]id_tindakan", [
                                                    // <span class="label-detail required">Barang</span>
                                                    'template' => '
                                            <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(Select2::classname(), [
                                                    'size' => 'md',
                                                    'options' => [
                                                        // 'id' => '',
                                                        'class' => 'dynamic-select2',
                                                        'placeholder' => 'Ketik Nama Tindakan...',
                                                    ],
                                                    'initValueText' => $modelDetail->tindakan->nama_tindakan ?? null,
                                                    'pluginOptions' => [
                                                        'dropdownAutoWidth' => true,
                                                        'allowClear' => false,
                                                        'minimumInputLength' => 2,
                                                        'language' => [
                                                            'errorLoading' => new JsExpression('function () { 
                                                        return "Menunggu hasil..."; 
                                                    }'),
                                                            'inputTooShort' => new JsExpression('function () {
                                                        return "Minimal 2 karakter...";
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
                                                    ],
                                                    'pluginEvents' => [
                                                        "select2:select" => new JsExpression('function(e) { 
                                                            let index = $(this).closest("tr").index()
                                                            let tindakanDipilih = e.params.data

                                                            // cek item sudah dipilih atau belum
                                                            let uda_dipilih = 0
                                                            $(\'.dynamicform_wrapper .form-options-item\').each(function (e) {
                                                                let id_barang_sudah_dipilih = $(this).find("select[name*=\'[id_tindakan]\']").val()
                                                                if (id_barang_sudah_dipilih == tindakanDipilih.id) {
                                                                    uda_dipilih++
                                                                    if (uda_dipilih == 2) {
                                                                        return false
                                                                    }
                                                                }
                                                            })

                                                            if (uda_dipilih == 2) {
                                                                $(`#layanandetail-${index}-id_tindakan`).val(null).trigger("change")
                                                                $(`#layanandetail-${index}-id_tindakan`).select2("open")
                                                                toastr.error(\'Upps,, Item sudah dipilih Bund. Coba yang lain ya\')
                                                            } else {
                                                                $(`#layanandetail-${index}-harga_jual-disp`).val(tindakanDipilih.harga_jual).trigger("change")
                                                                let subtotal = $(`#layanandetail-${index}-jumlah`).val() * tindakanDipilih.harga_jual
                                                                $(`#layanandetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                                                                $(`#layanandetail-${index}-jumlah-disp`).focus()
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
                                            <td style="padding-top: 3.5px;">
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]status", [
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>'
                                                ])
                                                    ->dropDownList(Layanan::find()->select2Status(), [
                                                        'prompt' => null
                                                    ])->label(false);
                                                ?>
                                            </td>
                                            <td style="padding-top: 3.5px;">
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
                                                    'class' => 'form-control form-control-md signa-typeahead det_signa',
                                                    'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                    'onfocus' => 'onFocusSelect(this)',
                                                ])->label(false);
                                                ?>
                                            </td>
                                            <td style="padding-top: 3.5px;">
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
                                                    'class' => 'form-control form-control-md det_jumlah',
                                                    'onkeypress' => 'enterNewRow(this, event.keyCode)',
                                                    'oninput' => 'inputJumlahHargaJual(this)',
                                                    'autocomplete' => 'off',
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td style="padding-top: 3.5px;">
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
                                                    'class' => 'form-control form-control-md det_harga_jual',
                                                    'readonly' => true,
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td style="padding-top: 3.5px;">
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
                                                    'class' => 'form-control form-control-md det_subtotal',
                                                    'readonly' => true,
                                                    'onchange' => 'onChangeSubtotal()',
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

                            <?php KyDynamicForm::end(); ?>


                        </div>
                    </div>

                    <div class="form-group float-right">
                        <?= Html::submitButton('[ ALT+S ] Simpan', ['class' => 'btn btn-success btn-simpan-form-tindakan']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs($this->render('_tindakan.js'), View::POS_END);
$this->registerJs($this->render('_tindakan_ready.js'));
