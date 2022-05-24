<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dokter */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<style>
    .form-group {
      margin-bottom: 0rem;
    }
</style>
<div class="dokter-form">
    <div class="card">

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
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
    

                    <?= $form->field($model, 'id_dokter')->hiddenInput(['maxlength' => true])->label(false) ?>
                    <?= $form->field($model, 'nama_dokter')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'gelar_depan')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'gelar_belakang')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'handphone')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan', ], ['prompt' => '']) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-outline-info']) ?>
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary float-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
