<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Dashboard';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>Selamat Datang, Selamat Beraktifitas <i><b><?= Yii::$app->user->identity->nama_lengkap ?></b></i></h3>
            <p>Halo!!</p>

            <hr>
            <span class="badge badge-primary">Tekan F1 Untuk Cari Pasien</span>
            <span class="badge badge-success">Tekan F2 Untuk Daftarkan Pasien</span>
          
        </div>
    </div>
</div>