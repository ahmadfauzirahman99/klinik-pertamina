<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-15 16:21:01 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-10-05 09:20:11
 */

use app\models\Dokter;
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
                        'id' => 'form-penunjang',
                        'layout' => 'horizontal',
                        // 'action' => ['/pos/penunjang'],
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

                            echo $form->field($model, "no_rekam_medik")->widget(Select2::classname(), [
                                'options' => [
                                    'placeholder' => 'Ketik No. RM / Nama Pasien...',
                                ],
                                'initValueText' => !$model->isNewRecord ? $model->no_rekam_medik : null,
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 3,
                                    // 'dropdownAutoWidth' => true,
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
                                                tanggal:$("#orderlab-tanggal").val()
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
                                        window.open(baseUrl + "/pos/penunjang" + "?reg=" + pasien.no_daftar + "&rm=" + pasien.no_rm, \'_self\');
                                    
                                        // let pasien = e.params.data
                                        //let tglLahir = new Date(pasien.TGL_LAHIR)

                                        // $(`#penjualan-no_daftar`).val(pasien.no_daftar).trigger("change")
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
                        <div class="form-group row field-orderlab-id_poli required">
                                <div class="col-sm-4">
                                    <label class="col-form-label-sm" for="orderlab-tanggal">Tanggal</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
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
                                    </div>
                                </div>
                            </div>
                            <?= $form->field($model, 'poli_id')->widget(Select2::classname(), [
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
                    
                    <!-- tindakan -->
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
                                    'formId' => 'form-penunjang',
                                    'formFields' => [
                                        'item_pemeriksaan',
                                        'nama_item',
                                        'harga_tindakan',
                                        'jumlah',
                                        'subtotal',
                                    ],
                                ]); ?>
                            

                            <table class="table-list-item table table-sm table-bordered table-hover" style="width: 100%;">
                                <thead class="bg-teal" style="text-align: center;">
                                    <tr class="bg-danger">
                                        <th style="color: white; font-size: 11px; width: 3%">#</th>
                                        <th style="color: white; font-size: 11px; width: 25%">Tindakan</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Jumlah</th>
                                        <th style="color: white; font-size: 11px; width: 14%">Harga Jual</th>
                                        <th style="color: white; font-size: 11px; width: 15%">Subtotal</th>
                                        <th style="color: white; font-size: 11px; width: 1%"></th>
                                    </tr>
                                </thead>
                                <tbody class="form-options-body">
                                    <?php 
                                        // var_dump($modelDetail);
                                        // die();
                                    foreach ($modelDetail as $i => $modelDetail) : ?>
                                        <tr class="form-options-item">

                                            <?php
                                            // necessary for update action.
                                            if (!$modelDetail->isNewRecord) {
                                                echo Html::activeHiddenInput($modelDetail, "[{$i}]id_order_lab_detail");
                                            }
                                            ?>
                                            <td style="text-align: center;">
                                                <span class="nomor">
                                                    <?= ($i + 1) ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?php
                                                $url = Url::to(['api-internal/cari-tindakanlab']);
                                                echo $form->field($modelDetail, "[{$i}]item_pemeriksaan", [
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
                                                    'initValueText' => $modelDetail->item->nama_item ?? null,
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
                                                            // id_depo:$("#penjualan-id_depo").val()
                                                        }; 
                                                    }')
                                                        ],
                                                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                        'templateResult' => new JsExpression('function(data) { 
                                                            
                                                            return (data.loading) ?
                                                                data.text : `${data.text}` ;     
                                                        }'),
                                                        'templateSelection' => new JsExpression('function (data) { return data.text; }'),
                                                    ],
                                                    'pluginEvents' => [
                                                        "select2:select" => new JsExpression('function(e) { 
                                                            let index = $(this).closest("tr").index()
                                                            let itemlabDipilih = e.params.data

                                                            // cek item sudah dipilih atau belum
                                                            let uda_dipilih = 0
                                                            $(\'.dynamicform_wrapper .form-options-item\').each(function (e) {
                                                                let item_pemeriksaan_sudah_dipilih = $(this).find("select[name*=\'[item_pemeriksaan]\']").val()
                                                                if (item_pemeriksaan_sudah_dipilih == itemlabDipilih.id) {
                                                                    uda_dipilih++
                                                                    if (uda_dipilih == 2) {
                                                                        return false
                                                                    }
                                                                }
                                                            })

                                                            if (uda_dipilih == 2) {
                                                                $(`#orderlabdetail-${index}-item_pemeriksaan`).val(null).trigger("change")
                                                                $(`#orderlabdetail-${index}-item_pemeriksaan`).select2("open")
                                                                toastr.error(\'Upps,, Item sudah dipilih ya Bund. Coba yang lain ya\')
                                                            } else {
                                                                $(`#orderlabdetail-${index}-harga_tindakan-disp`).val(itemlabDipilih.harga_tindakan).trigger("change")
                                                                let subtotal = $(`#orderlabdetail-${index}-jumlah`).val() * itemlabDipilih.harga_tindakan
                                                                $(`#orderlabdetail-${index}-subtotal-disp`).val(subtotal).trigger("change")
                                                                $(`#orderlabdetail-${index}-jumlah-disp`).focus()
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
                                                ]])->label(false);
                                                ?>
                                            </td>
                                            <td style="padding-top: 3.5px;">
                                                <?php
                                                echo $form->field($modelDetail, "[{$i}]harga_tindakan", [
                                                    // <span class="label-detail">Jlh. Diterima</span>
                                                    'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                                                ])->widget(KyNumber::className(), ['displayOptions' => [
                                                    'class' => 'form-control form-control-md det_harga_tindakan',
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
                                        <td style="text-align: center;" colspan="5">
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
                                            'onchange' => 'onChangeTotalHarga()',
                                        ]])->label(false);
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group float-right">
                        <?= Html::submitButton('[ ALT+S ] Simpan', ['class' => 'btn btn-success btn-simpan-form-penunjang']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
$this->registerJs($this->render('_penunjang.js'), View::POS_END);
$this->registerJs($this->render('_penunjang_ready.js'));
