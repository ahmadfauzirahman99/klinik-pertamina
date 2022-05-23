<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<style>
    #form .col-form-label {
        font-size: small;
    }

    #form .form-group {
        margin-bottom: 0.2rem;
    }
</style>
<div class="pekerjaan-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']); ?>

    <?= $form->field($model, 'nama_pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aktif')->dropdownList(['0' => 'Aktif', '1' => 'Tidak Aktif'], ['prompt' => 'Status'])->label('Status') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>