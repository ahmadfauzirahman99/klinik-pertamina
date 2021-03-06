<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PasienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <?= Html::a('Tambah Pasien', ['create'], ['class' => 'btn btn-success btn-rounded btn-trans']) ?>
                    </div>
                </div>
                <hr>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-sm table-bordered table-striped table-hover table-list-item'
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                        ],

                        // 'id_patient',
                        [
                            'attribute' => 'no_rekam_medik',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                        ],
                        // 'no_identitas',
                        // '',
                        [
                            'attribute' => 'no_kepesertaan',
                            'headerOptions' => ['style' => 'padding-left:10px;'],
                            'contentOptions' => ['style' => 'padding-left:10px;width:200px'],
                        ],
                        [
                            'attribute' => 'nama_lengkap',
                            'headerOptions' => ['style' => 'padding-left:10px;'],
                            'contentOptions' => ['style' => 'padding-left:10px;width:200px'],
                        ],
                        // 'tanggal_lahir',
                        [
                            'attribute' => 'tanggal_lahir',
                            'headerOptions' => ['style' => 'padding-left:10px;'],
                            'contentOptions' => ['style' => 'padding-left:10px;width:200px'],
                        ],
                        [
                            'attribute' => 'jenis_kelamin',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                        ],
                        // 'jenis_kelamin',
                        // 'alamat_lengkap:ntext',
                        //'kel',
                        //'kec',
                        //'kab',
                        //'no_tlp_pasien',
                        //'agama',
                        //'status_perkawinan',
                        // 'pendidikan_terakhir',
                        // [
                        //     'attribute' => 'pekerjaan_terakhir',
                        //     'value' => function ($model) {
                        //         return empty($model->pekerjaan) ? '' : $model->pekerjaan->nama_pekerjaan ;
                        //     },
                        //     'headerOptions' => ['style' => 'padding-left:10px;'],
                        //     'contentOptions' => ['style' => 'padding-left:10px;'],
                        // ],
                        //'profesi',
                        //'kewenegaraan',
                        // 'cara_pembayaran',
                        //'nama_penanggung_jawab',
                        //'is_penanggung_jawab',
                        //'hubungan_dengan_pasien',
                        //'no_telp',
                        //'rt',
                        //'rw',
                        //'crt_by',
                        //'anak_keberapa',
                        //'nama_ayah',
                        //'nama_ibu',
                        //'tempat_lahir',
                        //'status_pasien',
                        //'foto:ntext',
                        //'foto_ktp:ntext',
                        //'status_pekerjaan',
                        //'crt',
                        //'upd',

                        [
                            'contentOptions' => ['style' => 'text-align:center'],
                            'class' => 'app\components\ActionColumn',
                            'visibleButtons' => [
                                'delete' => function ($model) {
                                    return false;
                                }
                            ]
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