<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Satuan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="satuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_satuan')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Satuan']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 1, 'placeholder' => 'Keterangan Satuan']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>