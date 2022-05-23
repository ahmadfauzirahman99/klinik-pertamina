<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Poli */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<style>
    #form .col-form-label {
        font-size: small;
    }

    #form .form-group {
        margin-bottom: 0.1rem;
    }
</style>
<div class="poli-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal','id'=>'form']); ?>

    <?= $form->field($model, 'nama_poli')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(['0' => 'Aktif', '1' => 'Tidak Aktif']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>