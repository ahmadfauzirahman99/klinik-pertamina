<?php

use yii\helpers\Url;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">



            <h4 class="header-title m-t-0 m-b-10">Pemeriksaan</h4>


            <a href="<?= Url::to(['/order-lab/index']) ?>" class="btn btn-primary waves-effect w-md waves-light m-b-5">Pemeriksaan Lab <span class="fa fa-thermometer-0 "></span></a>
            <button type="button" class="btn btn-secondary waves-effect w-md m-b-5">Pemeriksaan Radiologi <span class="fa fa-snowflake-o "></span></button>
            <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Reset Obat <span class="fa  fa-rss-square"></span></button>
            <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Permintaan Konsul <span class="fa fa-send"></span></button>
            <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Proses Perawatan <span class="fa fa-send"></span></button>
        </div>
    </div><!-- end col -->
</div>