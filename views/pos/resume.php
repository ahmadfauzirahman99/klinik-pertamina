<?php

use app\components\number\KyNumber;
use dickyermawan\base\KyDynamicForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Resume Rawat Jalan';

?>
<div>

    <style>
        form .col-form-label-sm,
        form .form-group {
            margin-bottom: 0.6rem;
        }

        .form-options-item td {
            padding: 2px 2px 0px 2px;
        }

        .tabel-total table td {
            padding: 1px !important;
        }

        .tabel-total table td .form-group {
            margin-bottom: 0px !important;
        }

        .tabel-total table td {
            text-align: right;
        }

        .tabel-total table td label {
            margin: 5px 5px 5px 5px !important;
            font-weight: bold;
            font-size: 0.8em;
        }

        .select2-container--open .select2-dropdown--below {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            width: 400px !important;
            min-width: 376.4px;
            position: relative;
        }
    </style>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs">
                        <?= $this->render('form-wizard', ['model' => '']) ?>
                    </ul>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'id' => 'form',
                        // 'action' => ['/pos/obat'],
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
                    <?php Pjax::begin(['id' => 'resume']) ?>

                    <?= $form->field($model, 'no_rekam_medik')->textInput(['readonly' => true]) ?>

                    <?= $form->field($model, 'no_daftar')->textInput(['readonly' => true]) ?>

                    <?= $form->field($model, 'anamnesa')->textarea(['rows' => 6, 'placeholder' => 'Entri Anamnesa']) ?>

                    <?= $form->field($model, 'hasil_penunjang')->textarea(['rows' => 6, 'placeholder' => 'Entri Penunjang']) ?>

                    <?= $form->field($model, 'diaganosa')->textarea(['rows' => 6, 'placeholder' => 'Entri Diagnosa']) ?>

                    <?= $form->field($model, 'therapy')->textarea(['rows' => 3, 'placeholder' => 'Entri Therapy yang diberikan']) ?>

                    <?php $form->field($model, 'created_at')->textInput() ?>

                    <?= $form->field($model, 'created_by')->hiddenInput(['maxlength' => true])->label(false) ?>

                    <?php $form->field($model, 'updated_at')->textInput() ?>

                    <?php $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

                    <hr>
                    <div class="form-group">
                        <?= Html::submitButton('Simpan Resume Rawat Jalan', ['class' => 'btn btn-success btn-rounded btn-submit']) ?>
                        &nbsp;
                        <?php if (!$model->isNewRecord) { ?>
                            <a class="btn btn-danger btn-trans btn-rounded" href="<?= Url::to(['laporan/resume-rawat-jalan', 'reg' => $reg]) ?>"><span class="fas fa-file-pdf"></span> Cetak Resume Rawat Jalan</a>
                        <?php } ?>
                    </div>

                    <?php Pjax::end() ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs($this->render('resume.js'), View::POS_END) ?>