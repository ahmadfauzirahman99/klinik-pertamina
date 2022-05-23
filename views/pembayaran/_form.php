<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pembayaran */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'riwayat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_daftar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'jam')->textInput() ?>

    <?= $form->field($model, 'total_harga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskon_persen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskon_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'json_detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
