<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResumeRawatJalan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="resume-rawat-jalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_rekam_medik')->textInput() ?>

    <?= $form->field($model, 'no_daftar')->textInput() ?>

    <?= $form->field($model, 'anamnesa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hasil_penunjang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'diaganosa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'therapy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
