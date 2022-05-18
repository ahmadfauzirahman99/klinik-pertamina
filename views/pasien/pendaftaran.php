<?php

use yii\bootstrap4\ActiveForm;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = "Pendaftaran Pasien - " . $model->nama_lengkap
?>
<style>
    #form .col-form-label {
        font-size: small;
    }

    #form .form-group {
        margin-bottom: 0.1rem;
    }
</style>



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
                            <?php $form = ActiveForm::begin([
                                'id' => 'form',
                                'layout' => 'horizontal',
                                // 'action' => 'simpan-pendaftaran'
                            ]); ?>

                            <div class="card border border-primary m-b-20">
                                <h5 class="card-header"><span class="mdi mdi-information-outline"></span> Pendaftaran Pasien</h5>
                                <div class="card-body">
                                    <?= $this->render('_form-pendaftaran', [
                                        'model' => $model,
                                        'pendaftaran' => $pendaftaran,
                                        'form' => $form
                                    ]) ?>
                                </div>
                            </div>
                            <div class="card border border-danger m-b-20">
                                <h5 class="card-header"><span class="mdi mdi-information-outline"></span> Pilih Poli Layanan</h5>
                                <div class="card-body">
                                    <?= $this->render('_layanan', [
                                        'model' => $model,
                                        'pendaftaran' => $pendaftaran,
                                        'layanan' => $layanan,
                                        'form' => $form

                                    ]) ?>
                                    <hr>
                                    <button class="btn btn-primary btn-submit btn-rounded btn-trans float-right ">Simpan/Daftarkan Pasien</button>

                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <?php Pjax::begin(['id' => 'pjax-pendaftaran']) ?>

                            <div class="card border border-danger m-b-20">
                                <h5 class="card-header"><span class="mdi mdi-information-outline"></span> List Pendaftaran</h5>
                                <div class="card-body">
                                    <?= $this->render('pasien-riwayat', [
                                        'searchModel' => $searchModel,
                                        'dataProvider' => $dataProvider,
                                        // 'model' => $model,
                                        // 'pendaftaran' => $pendaftaran,
                                        'layanan' => $layanan,
                                        'form' => $form

                                    ]) ?>
                                    <hr>

                                </div>
                            </div>
                            <?php Pjax::end() ?>

                        </div>
                        <div class="col-md-6">
                            <?php Pjax::begin(['id' => 'pjax-timeline']) ?>

                            <div class="card border border-danger m-b-20">
                                <h5 class="card-header"><span class="mdi mdi-information-outline"></span> Timeline Pendaftaran Pasien</h5>
                                <div class="card-body">
                                    <?= $this->render('timeline', [
                                        'searchModel' => $searchModel,
                                        'dataProvider' => $dataProvider,
                                        'model' => $model,
                                        'model_timeline_kunjungan' => $model_timeline_kunjungan,
                                        'pendaftaran' => $pendaftaran,
                                        'layanan' => $layanan,
                                        'form' => $form

                                    ]) ?>
                                    <hr>

                                </div>
                            </div>
                            <?php Pjax::end() ?>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->registerJs($this->render('pendaftaran.js'), View::POS_END) ?>