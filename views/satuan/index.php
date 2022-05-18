<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SatuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Satuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <?= Html::a('Tambah Satuan', ['create'], ['class' => 'btn btn-success btn-rounded btn-trans']) ?>
                    </div>
                </div>
                <hr>


                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table table-sm table-bordered table-hover table-list-item'
                    ],
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'contentOptions' => ['style' => 'text-align:center'],

                        ],

                        // 'id_satuan',
                        // 'is_active',
                        // 'created_by',
                        'created_at',
                        // 'updated_by',
                        //'updated_at',
                        //'is_deleted',
                        //'deleted_by',
                        //'deleted_at',
                        //'riwayat:ntext',
                        'nama_satuan',
                        // 'keterangan:ntext',

                        [
                            'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'text-align:center'],

                        ],
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