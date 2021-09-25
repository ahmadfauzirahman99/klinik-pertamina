<?php

use app\components\number\KyNumber;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemLab */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="item-lab-form">


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
                        <?= $form->field($model, 'id_item_lab')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'nama_item')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'harga_item', [
                            'template' => '{label}<div class="col-sm-9">{input}{hint}{error}</div>',
                            ])->widget(KyNumber::className(), []) ?>
                        <?= $form->field($model, 'nama_jenis')->dropDownList([ 'Lab PK' => 'Lab PK', 'Radiologi' => 'Radiologi' ], ['prompt' => '']) ?>
                        
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
