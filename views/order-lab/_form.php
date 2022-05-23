<?php

use app\models\Poli;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\OrderLab */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #form .col-form-label {
        font-size: small;
    }

    #form .form-group {
        margin-bottom: 0.1rem;
    }
</style>
<div class="order-lab-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'layout' => 'horizontal']); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'no_transaksi')->textInput(['maxlength' => true, 'placeholder' => 'No Transaksi']) ?>
            <?= $form->field($model, 'no_rekam_medik')->textInput(['maxlength' => true, 'placeholder' => 'No Rekam Medik']) ?>

            <?= $form->field($model, 'no_daftar')->textInput(['maxlength' => true, 'placeholder' => 'No Daftar']) ?>

            <?= $form->field($model, 'poli_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Poli::find()->all(), 'id_poli', 'nama_poli'),
                'options' => ['placeholder' => 'Poli Pelayanan'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $form->field($model, 'kondisi_sampel', ['inputOptions' =>  ['class' => 'form-control form-control-sm']])->inline(true)->radioList(['Cukup' => 'Cukup', 'Kurang' => 'Kurang', 'Beku' => 'Beku', 'Lisis' => 'Lisis', 'Ikterik' => 'Ikterik', 'Lipemik' => 'Lipemik']) ?>


        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'catatan')->textarea(['rows' => 2, 'placeholder' => 'Catatan']) ?>
            <?= $form->field($model, 'diagnosa')->textarea(['rows' => 2, 'placeholder' => 'Diagnosa']) ?>


        </div>
    </div>


    <?php $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'created_at')->textInput() ?>

    <?php $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'updated_at')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>