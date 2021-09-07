<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="kategori-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'layout' => 'horizontal']); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'placeholder'=>'Nama Kategori Item']) ?>

    <?php $form->field($model, 'waktu_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>