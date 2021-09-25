<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dosis */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="dosis-form">
    <div class="card">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2 col-form-label-sm',
                    'wrapper' => 'col-sm-10',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'nama_dosis')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-outline-info']) ?>
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary float-right']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
