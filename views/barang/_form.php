<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_barang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis')->dropDownList([ 'obat' => 'Obat', 'alkes' => 'Alkes', 'racikan' => 'Racikan', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_kategori')->textInput() ?>

    <?= $form->field($model, 'id_satuan')->textInput() ?>

    <?= $form->field($model, 'merk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gambar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga_terakhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga_tertinggi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga_jual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stok')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
