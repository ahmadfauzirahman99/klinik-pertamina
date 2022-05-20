<?php

use dickyermawan\base\KyDynamicForm;
use dickyermawan\base\KyNumber;
use kartik\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

?>

<?php KyDynamicForm::begin([
    'widgetContainer' => 'dynamicform_wrapper_obat',
    'widgetBody' => '.form-options-body-obat-racikan-detail',
    'widgetItem' => '.form-options-item-obat-racikan-detail',
    'min' => 1,
    'insertButton' => '.add-item-obat-racikan-detail',
    'deleteButton' => '.delete-item-obat-racikan-detail',
    'model' => $modelRacikanDetail[0],
    'formId' => 'form-obat',
    'formFields' => [
        'id_racikan_detail',
        'dosis',
        'keterangan',
        'harga_jual',
        'jumlah',
        'subtotal',
    ],
]); ?>

<table class="table-list-item table table-sm table-bordered table-hover" style="width: 100%;">
    <thead class="bg-teal" style="text-align: center;">
        <tr class="bg-success">
            <th style="color: white; font-size: 11px; width: 25%">Barang</th>
            <th style="color: white; font-size: 11px; width: 14%">Keterangan</th>
            <th style="color: white; font-size: 11px; width: 14%">Dosis</th>
            <th style="color: white; font-size: 11px; width: 14%">Jumlah</th>
            <th style="color: white; font-size: 11px; width: 14%">Harga Jual</th>
            <th style="color: white; font-size: 11px; width: 15%">Subtotal</th>
            <th style="color: white; font-size: 11px; width: 1%"></th>
        </tr>
    </thead>
    <tbody class="form-options-body-obat-racikan-detail">
        <?php foreach ($modelRacikanDetail as $z => $modelRacikanDetail) : ?>
            <tr class="form-options-item-obat-racikan-detail">

                <?php
                // necessary for update action.
                if (!$modelRacikanDetail->isNewRecord) {
                    echo Html::activeHiddenInput($modelRacikanDetail, "[{$indexRacikan}][{$z}]id_racikan_detail");
                }
                ?>


                <td>
                    <?php
                    $url = Url::to(['api-internal/cari-obat']);
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]id_racikan_detail", [
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
                            'placeholder' => 'Ketik Nama Barang...',
                            'onchange' => 'ubahSelect2(this)'
                        ],
                        'initValueText' => $modelRacikanDetail->barang->nama_barang ?? null,
                        'pluginOptions' => [
                            'dropdownAutoWidth' => true,
                            'allowClear' => false,
                            'minimumInputLength' => 2,
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
                                                        warnaInfoStok = "warning"
                                                        teksStok = "Kosong"
                                                    }else {
                                                        warnaInfoStok = "success"
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
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]keterangan", [
                        // <span class="label-detail">Jlh. Diterima</span>
                        'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                    ])->textInput([
                        'class' => 'form-control form-control-md signa-typeahead det_signa',
                        'onkeypress' => 'enterNewRowRacikan(this, event.keyCode)',
                        'onfocus' => 'onFocusSelectRacikan(this)',
                    ])->label(false);
                    ?>
                </td>
                <td style="padding-top: 3.5px;">
                    <?php
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]dosis", [
                        // <span class="label-detail">Jlh. Diterima</span>
                        'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                    ])->textInput([
                        'class' => 'form-control form-control-md signa-typeahead det_signa',
                        'onkeypress' => 'enterNewRowRacikan(this, event.keyCode)',
                        'onfocus' => 'onFocusSelectRacikan(this)',
                    ])->label(false);
                    ?>
                </td>

                <td style="padding-top: 3.5px;">
                    <?php
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]jumlah", [
                        // <span class="label-detail">Jlh. Diterima</span>
                        'template' => '
                                                <div class="col-sm-12">
                                                    {input}
                                                    {hint}{error}
                                                </div>
                                            ',
                    ])->widget(KyNumber::className(), ['displayOptions' => [
                        'class' => 'form-control form-control-md det_jumlah',
                        // 'onkeypress' => 'enterNewRowRacikan(this, event.keyCode)',
                        'oninput' => 'inputJumlahHargaJualRacikan(this)',
                        'autocomplete' => 'off',
                    ]])->label(false);
                    ?>
                </td>
                <td style="padding-top: 3.5px;">
                    <?php
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]harga_jual", [
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
                    echo $form->field($modelRacikanDetail, "[{$indexRacikan}][{$z}]subtotal", [
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
                        'onchange' => 'onChangeSubtotalRacikan(this)',
                    ]])->label(false);
                    ?>
                </td>
                <td style="text-align: center;">
                    <button type="button" class="delete-item-obat-racikan-detail btn btn-xs" title="Hapus Item">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: center;" colspan="6">
            </td>
            <td class="text-center">
                <button type="button" class="add-item-obat-racikan-detail btn btn-xs" title="Tambah Item">
                    <i class="fas fa-plus text-info"></i>
                </button>
            </td>
        </tr>
    </tfoot>
</table>

<?php KyDynamicForm::end(); ?>


<?php $this->registerJs($this->render('_obat_racikan_ready.js'), View::POS_END) ?>
<?php $this->registerJs($this->render('_obat_racikan.js'), View::POS_END) ?>