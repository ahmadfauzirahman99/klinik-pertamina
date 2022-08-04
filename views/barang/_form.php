<?php

use app\components\number\KyNumber;
use app\models\Kategori;
use app\models\Satuan;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<style>
    .form-group {
        margin-bottom: 0rem;
    }
</style>
<div class="barang-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3 col-form-label-sm',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_barang')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'jenis')->dropDownList(['obat' => 'Obat', 'alkes' => 'Alkes', 'racikan' => 'Racikan',], ['prompt' => '']) ?>
            <?php
            echo $form->field($model, 'id_kategori')->widget(Select2::classname(), [
                'data' => Kategori::find()->select2(),
                'options' => ['placeholder' => 'Pilih...',],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label('Kategori');
            ?>
            <?php
            echo $form->field($model, 'id_satuan')->widget(Select2::classname(), [
                'data' => Satuan::find()->select2(),
                'options' => ['placeholder' => 'Pilih...',],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label('Satuan');
            ?>
            <?= $form->field($model, 'merk')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'gambar')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'harga_terakhir', [
                'template' => '{label}<div class="col-sm-9">{input}{hint}{error}</div>',
            ])->widget(KyNumber::className(), []) ?>
            <?= $form->field($model, 'harga_tertinggi', [
                'template' => '{label}<div class="col-sm-9">{input}{hint}{error}</div>',
            ])->widget(KyNumber::className(), []) ?>
            <?= $form->field($model, 'harga_jual', [
                'template' => '{label}<div class="col-sm-9">{input}{hint}{error}</div>',
            ])->widget(KyNumber::className(), []) ?>
            <?= $form->field($model, 'stok', [
                'template' => '{label}<div class="col-sm-9">{input}{hint}{error}</div>',
            ])->widget(KyNumber::className(), []) ?>


        </div>
    </div>
    <hr>
    <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-outline-info']) ?>
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary float-right']) ?>
    <?php ActiveForm::end(); ?>
</div>