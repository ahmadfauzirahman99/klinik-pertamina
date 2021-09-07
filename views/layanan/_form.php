<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Layanan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'registrasi_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_layanan')->textInput() ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <?= $form->field($model, 'tgl_keluar')->textInput() ?>

    <?= $form->field($model, 'unit_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_asal_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_tujuan_kode')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'status_layanan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
