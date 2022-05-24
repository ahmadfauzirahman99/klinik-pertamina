<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .logo,h4 {
        font-family: 'Roboto' !important;
        font-weight: 500 !important;
    }
</style>
<br><br>
<div class="site-login">
    <div class="wrapper-page">
        <div class="text-center">
            <a href="<?= Url::to(['site/login']) ?>" class="logo"><span>Point Of<span> Sale</span></span></a>
            <h5 class="text-muted m-t-0 font-600">Rumah Sakit Syafira</h5>
        </div>
        <div class="m-t-40 card-box">
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">Halo Selamat Datang</h4>
            </div>
            <div class="p-20">

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    // 'layout' => 'horizontal',
                    'options' => [
                        'class' => 'form-horizontal m-t-20'
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => false, 'class' => 'form-control  form-control-md',])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-md'])->label(false) ?>
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>