<?php

use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

?>

<?php $form = ActiveForm::begin([
    'action' => ['cari-pasien-modal'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ],
    'layout' => 'horizontal',
    'id' => 'form-patient',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-2 col-form-label',
            'wrapper' => 'col-sm-10',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<?php
$url = Url::to(['pasien/api-pasien']);

echo $form->field($model, "no_rekam_medik")->widget(Select2::classname(), [
    'options' => [
        'placeholder' => 'Ketik No. RM / Nama Pasien...',
    ],
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

        'templateSelection' => new JsExpression('function (data) { return data.no_rm ? data.no_rm : data.text; }'),
    ],
    'pluginEvents' => [
        "select2:select" => new JsExpression('function(e) { 
                                  
                                        window.location = baseUrl + "pasien/pendaftaran" + "?id=" + e.params.data.id;
                                    

                                    }'),
    ]
])->label('Masukan');
?>
<?php ActiveForm::end(); ?>