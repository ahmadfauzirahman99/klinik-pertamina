<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderLab */
?>
<div class="order-lab-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lab',
            'no_transaksi',
            'poli_id',
            'diagnosa:ntext',
            'kondisi_sampel',
            'catatan:ntext',
            'no_rekam_medik',
            'no_daftar',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
