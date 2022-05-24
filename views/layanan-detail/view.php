<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LayananDetail */

$this->title = $model->id_layanan_detail;
$this->params['breadcrumbs'][] = ['label' => 'Layanan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_layanan_detail], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_layanan_detail], [
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
                            'id_layanan_detail',
                            'created_by',
                            'created_at',
                            'updated_by',
                            'updated_at',
                            'is_deleted',
                            'deleted_by',
                            'deleted_at',
                            'riwayat:ntext',
                            'id_layanan',
                            'id_tindakan',
                            'keterangan',
                            'harga_jual',
                            'jumlah',
                            'subtotal',
                            'status',
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
</div>