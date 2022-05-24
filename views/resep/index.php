<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reseps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Resep', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_resep',
                            'created_by',
                            'created_at',
                            'updated_by',
                            'updated_at',
                            //'is_deleted',
                            //'deleted_by',
                            //'deleted_at',
                            //'riwayat:ntext',
                            //'no_daftar',
                            //'no_rm',
                            //'id_poli',
                            //'id_dokter',
                            //'tanggal',
                            //'jam',
                            //'is_retur',
                            //'tanggal_retur',
                            //'retur_by',
                            //'total_harga',
                            //'diskon_persen',
                            //'diskon_total',
                            //'total_bayar',

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
</div>
