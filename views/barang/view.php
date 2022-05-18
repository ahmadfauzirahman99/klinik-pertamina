<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = $model->id_barang;
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id_barang], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_barang], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id_barang',
                        // 'created_by',
                        // 'created_at',
                        // 'updated_by',
                        // 'updated_at',
                        // 'is_deleted',
                        // 'deleted_by',
                        // 'deleted_at',
                        // 'riwayat:ntext',
                        'jenis',
                        'id_kategori',
                        'id_satuan',
                        'merk',
                        'nama_barang',
                        'keterangan',
                        // 'lokasi',
                        // 'gambar',
                        'harga_terakhir',
                        'harga_tertinggi',
                        'harga_jual',
                        'stok',
                    ],
                ]) ?>
            </div>
            <!--.col-md-12-->
        </div>
        <!--.row-->
    </div>
    <!--.card-body-->
</div>
<!--.card-->