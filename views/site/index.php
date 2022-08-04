<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\web\View;

$this->title = 'Dashboard';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h3>Selamat Datang, Selamat Beraktifitas <i><b><?= Yii::$app->user->identity->nama_lengkap ?></b></i></h3>
                <p>Halo!!</p>
                <span class="badge badge-primary">Tekan F1 Untuk Cari Pasien</span>
                <span class="badge badge-success">Tekan F2 Untuk Daftarkan Pasien</span>
            </div>
        </div>
        <div class="offset-md-4 col-md-4 mt-1">
            <div class="card-box widget-user">
                <img src="<?= Url::to('@web/img/engineers.png') ?>" class="img-responsive rounded-circle" alt="user">
                <div class="wid-u-info">
                    <h5 class="mt-0 m-b-5"><?= strtoupper(Yii::$app->user->identity->username) ?></h5>
                    <p class="text-muted m-b-5 font-13"><?= Yii::$app->user->identity->nama_lengkap ?></p>
                    <small class="text-warning"><b><?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->tgl_pendaftaran) ?></b></small>
                </div>
            </div>
        </div>
    </div>
</div>