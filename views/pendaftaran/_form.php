<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pendaftaran */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pendaftaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pendaftaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_pasien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <?= $form->field($model, 'tgl_keluar')->textInput() ?>

    <?= $form->field($model, 'id_kiriman')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_cara_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
