<?php

use app\models\DebiturDetail;
use app\models\Kiriman;
use kartik\select2\Select2;
use yii\base\Theme;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

?>


<!-- <div class="row"> -->

<!-- <div class="col-lg-12"> -->
<?= $form->field($pendaftaran, 'kode_pasien')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'value' => $model->no_rekam_medik, 'readonly' => true]) ?>
<?= $form->field($pendaftaran, 'id_kiriman')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Kiriman::find()->all(), 'kode', 'nama'),
    'options' => ['placeholder' => 'Kiriman Dari'],
    'theme' => Select2::THEME_BOOTSTRAP,
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($pendaftaran, 'id_cara_bayar')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DebiturDetail::find()->all(), 'id_debitur_kode', 'nama'),
    'options' => ['placeholder' => 'Cara Bayar'],
    'theme' => Select2::THEME_BOOTSTRAP,
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
