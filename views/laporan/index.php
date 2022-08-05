<?php
/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\base\Theme;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Laporan Rekap';

$bulan = 12;


?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <?php for ($i = 1; $i <= $bulan; $i++) { ?>
                <a target="_blank" href="<?= Url::to(['/laporan/cetak-resep-semua', 'bulan' => $i]) ?>" class="btn btn-primary btn-block mb-2"> Cetak Laporan Bulan <?= $i ?> 2022 </a>
            <?php } ?>
            <hr>
            <a target="_blank" href="<?= Url::to(['/laporan/klinik-raw', 'id' => date('Y')]) ?>" class="btn btn-success btn-block mb-2"> Cetak Excel Tahun <?= date('Y') ?></a>

        </div>
    </div>
</div>