<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Update Pasien: ' . $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_lengkap, 'url' => ['view', 'id' => $model->id_patient]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
    #form .col-form-label {
        font-size: 9.5px;
    }

    #form .form-group {
        margin-bottom: 0.1rem;
    }
</style>
<style>
    .float-group {
        position: fixed;
        bottom: 90px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        text-align: center;
        box-shadow: 2.5px 2.5px 5px #999;
        z-index: 100;
    }

    .float {
        position: fixed;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        text-align: center;
        box-shadow: 2.5px 2.5px 5px #999;
        z-index: 100;
    }
</style>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'id' => 'form',
    'options' => ['enctype' => 'multipart/form-data', 'autocomplete' => 'off'],
]); ?>
<?php Pjax::begin(['id' => 'pjax-pasien']) ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        <?= $this->render('form-wizard', ['model' => $model]) ?>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <h4 class="m-t-0 header-title">Biodata Pasien</h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Berisi Tentang Informasi Demografi Pasien
                                    </p>
                                    <?= $this->render('_form', [
                                        'model' => $model,
                                        'form' => $form
                                    ]) ?>
                                    <hr>
                                    <div class="form-group">
                                        <?= Html::submitButton('Simpan Data Pasien', ['class' => 'btn btn-success btn-rounded']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card border border-primary" style="margin-top: 10px;">
                                <div class="card-body">
                                    <h4 class="m-t-0 header-title">Form Keluarga</h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Berisi Tentang Informasi Keluarga
                                    </p>
                                    <?= $this->render('_form-keluarga', [
                                        'model' => $model,
                                        'form' => $form
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card border border-primary">

                                <div class="card-body">
                                    <h4 class="m-t-0 header-title">Foto Identitas/Ktp</h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Berisi Tentang Informasi Foto Pasien Dan KTP Pasien
                                    </p>
                                    <?= $this->render('_foto-pasien', [
                                        'model' => $model,
                                        'form' => $form
                                    ]) ?>
                                </div>
                            </div>

                            <div class="card border border-primary" style="margin-top: 10px;">

                                <div class="card-body">
                                    <h4 class="m-t-0 header-title">Nomor Identitas/RM/Kepesertaan Pasien</h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Berisi Tentang Informasi Nomor Telepon Pasien/Nomor Rekam Medik/Kepesertaan Pasien
                                    </p>
                                    <?= $this->render('_form-medik', [
                                        'model' => $model,
                                        'form' => $form
                                    ]) ?>
                                </div>
                            </div>

                            <div class="card border border-primary" style="margin-top: 10px;">

                                <div class="card-body">
                                    <h4 class="m-t-0 header-title">Penanggung Jawab Pasien</h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Berisi Tentang Informasi Penanggung Jawab Pasien
                                    </p>

                                    <?= $this->render('_form-penanggung-jawab', [
                                        'model' => $model,
                                        'form' => $form
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--.card-body-->

                </div>
            </div>

        </div>
    </div>
    <!--.card-->
</div>
<br>
<?php Pjax::end() ?>
<?php ActiveForm::end(); ?>
<?php $this->registerJs($this->render('_form.js'), View::POS_END) ?>