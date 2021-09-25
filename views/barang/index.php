<?php

use app\models\Satuan;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_barang',
                            // 'created_by',
                            // 'created_at',
                            // 'updated_by',
                            // 'updated_at',
                            //'is_deleted',
                            //'deleted_by',
                            //'deleted_at',
                            //'riwayat:ntext',
                            //'jenis',
                            //'id_kategori',
                            //'merk',
                            'nama_barang',
                            [
                                'label' => 'Satuan',
                                // 'headerOptions' => ['style' => 'width: 5%;'],
                                'attribute' => 'id_satuan',
                                'value' => 'satuan.nama_satuan',
                                'filter' => Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'id_satuan',
                                    'data' => Satuan::find()->select2(),
                                    'options' => ['placeholder' => 'Pilih...',],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownAutoWidth' => true,
                                    ],
                                ]),
                            ],
                            //'keterangan',
                            'lokasi',
                            //'gambar',
                            //'harga_terakhir',
                            'harga_tertinggi',
                            'harga_jual',
                            'stok',

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
