<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Resep */

$this->title = $model->id_resep;
$this->params['breadcrumbs'][] = ['label' => 'Reseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_resep], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_resep], [
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
                            'id_resep',
                            'created_by',
                            'created_at',
                            'updated_by',
                            'updated_at',
                            'is_deleted',
                            'deleted_by',
                            'deleted_at',
                            'riwayat:ntext',
                            'no_daftar',
                            'no_rm',
                            'id_poli',
                            'id_dokter',
                            'tanggal',
                            'jam',
                            'is_retur',
                            'tanggal_retur',
                            'retur_by',
                            'total_harga',
                            'diskon_persen',
                            'diskon_total',
                            'total_bayar',
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