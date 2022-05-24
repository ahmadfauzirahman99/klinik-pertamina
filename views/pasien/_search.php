<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PasienSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_patient') ?>

    <?= $form->field($model, 'no_identitas') ?>

    <?= $form->field($model, 'no_rekam_medik') ?>

    <?= $form->field($model, 'no_kepesertaan') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'alamat_lengkap') ?>

    <?php // echo $form->field($model, 'kel') ?>

    <?php // echo $form->field($model, 'kec') ?>

    <?php // echo $form->field($model, 'kab') ?>

    <?php // echo $form->field($model, 'no_tlp_pasien') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'status_perkawinan') ?>

    <?php // echo $form->field($model, 'pendidikan_terakhir') ?>

    <?php // echo $form->field($model, 'pekerjaan_terakhir') ?>

    <?php // echo $form->field($model, 'profesi') ?>

    <?php // echo $form->field($model, 'kewenegaraan') ?>

    <?php // echo $form->field($model, 'cara_pembayaran') ?>

    <?php // echo $form->field($model, 'nama_penanggung_jawab') ?>

    <?php // echo $form->field($model, 'is_penanggung_jawab') ?>

    <?php // echo $form->field($model, 'hubungan_dengan_pasien') ?>

    <?php // echo $form->field($model, 'no_telp') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'crt_by') ?>

    <?php // echo $form->field($model, 'anak_keberapa') ?>

    <?php // echo $form->field($model, 'nama_ayah') ?>

    <?php // echo $form->field($model, 'nama_ibu') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'status_pasien') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'foto_ktp') ?>

    <?php // echo $form->field($model, 'status_pekerjaan') ?>

    <?php // echo $form->field($model, 'crt') ?>

    <?php // echo $form->field($model, 'upd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>
