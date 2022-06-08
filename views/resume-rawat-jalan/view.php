<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResumeRawatJalan */

$this->title = $model->id_resume_rawat_jalan;
$this->params['breadcrumbs'][] = ['label' => 'Resume Rawat Jalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_resume_rawat_jalan], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_resume_rawat_jalan], [
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
                            'id_resume_rawat_jalan',
                            'no_rekam_medik',
                            'no_daftar',
                            'anamnesa:ntext',
                            'hasil_penunjang:ntext',
                            'diaganosa:ntext',
                            'therapy:ntext',
                            'created_at',
                            'created_by',
                            'updated_at',
                            'updated_by',
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