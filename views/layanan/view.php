<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Layanan */

$this->title = $model->id_layanan;
$this->params['breadcrumbs'][] = ['label' => 'Layanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_layanan], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_layanan], [
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
                            'id_layanan',
                            'registrasi_kode',
                            'jenis_layanan',
                            'tgl_masuk',
                            'tgl_keluar',
                            'unit_kode',
                            'unit_asal_kode',
                            'unit_tujuan_kode',
                            'keterangan:ntext',
                            'created_by',
                            'created_at',
                            'updated_by',
                            'updated_at',
                            'deleted_at',
                            'deleted_by',
                            'status_layanan',
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