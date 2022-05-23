<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Dokter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <?= Html::a('Tambah Dokter', ['create'], ['class' => 'btn btn-success btn-rounded btn-trans']) ?>
                    </div>
                </div>
                <hr>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id_dokter',
                        // 'created_by',
                        // 'created_at',
                        // 'updated_by',
                        // 'updated_at',
                        //'is_deleted',
                        //'deleted_by',
                        //'deleted_at',
                        //'riwayat:ntext',
                        [
                            'attribute' => 'nama_dokter',
                            'value' => function ($model) {
                                return $model->nama_dokter . ($model->gelar_depan ? ', ' . $model->gelar_depan : null) . ($model->gelar_belakang ? ', ' . $model->gelar_belakang : null);
                            }
                        ],
                        // 'gelar_depan',
                        // 'gelar_belakang',
                        // 'alamat',
                        // 'telepon',
                        'handphone',
                        'jenis_kelamin',

                        ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                    ],
                    'summaryOptions' => ['class' => 'summary mb-2'],
                    'pager' => [
                        'class' => 'yii\bootstrap4\LinkPager',
                    ]
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
            <!--.card-body-->
        </div>
        <!--.card-->
    </div>
    <!--.col-md-12-->
</div>
<!--.row-->