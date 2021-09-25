<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-05-30 21:47:13 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-24 17:35:24
 */

use app\models\layanan\Layanan;
use app\models\Poli;
use app\models\unit_layanan\UnitLayanan;
use kartik\select2\Select2;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

?>

<div class="">
    <?php Pjax::begin([
        'id' => 'riwayat-kunjungan',
        'timeout' => false,
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-sm table-bordered table-hover table-list-item'
        ],
        // 'rowOptions' => function ($model, $index, $widget, $grid) {
        //     if ($model->status_layanan == 'DAFTAR')
        //         return ['class' => 'bg-pink'];
        //     if ($model->status_layanan == 'DILAYANI')
        //         return ['class' => 'table-info'];
        //     if ($model->status_layanan == 'SELESAI')
        //         return ['class' => 'bg-teal'];
        //     if ($model->status_layanan == 'BATAL')
        //         return ['class' => 'bg-orange'];
        // },
        'columns' => [
            [
                'headerOptions' => ['style' => 'width:10px'],

                'class' => 'yii\grid\SerialColumn'
            ],

            // 'id_layanan',
            [
                'attribute' => 'registrasi_kode',
                'headerOptions' => ['style' => 'width:130px'],
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a data-pjax="0"  href="' . Url::to(['/pos/tindakan', 'reg' => $model->registrasi_kode, 'rm' => $model->pendaftaran->kode_pasien]) . '" target="_blank">' . $model->registrasi_kode . '</a>';
                }
            ],
            [
                'attribute' => 'tgl_masuk',
                'headerOptions' => ['style' => 'width:130px'],
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->tgl_masuk);
                }
            ],
            // 'jenis_layanan',
            // 'tgl_masuk',
            // 'tgl_keluar',
            //'unit_kode',
            // 'unit_asal_kode',
            [
                'headerOptions' => ['style' => 'width:130px'],
                'attribute' => 'unit_tujuan_kode',
                'value' => 'unit.nama_poli',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'unit_tujuan_kode',
                    'data' => ArrayHelper::map(Poli::find()->all(), 'id_poli', 'nama_poli'),
                    'options' => ['placeholder' => 'Pilih...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        // 'dropdownAutoWifvdth' => true
                    ],
                ]),
            ],
            // 'status_layanan'

            //'keterangan',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
            //'deleted_at',
            //'deleted_by',
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header' => 'Actions',
            //     'headerOptions' => ['style' => 'color:#337ab7;text-align:center;width:130px'],
            //     'template' => '{periksa}',
            //     'buttons' => [
            //         'periksa' => function ($url, $model) {
            //             return Html::a(
            //                 '<span class="fas fa-list"></span>',
            //                 ['/pasien/okupasi', 'id' => $model->id_layanan, 'no_register' => $model->registrasi_kode],
            //                 [
            //                     'title' => Yii::t('app', 'lihat'),
            //                     'class' => 'btn bg-navy btn-sm',
            //                     'data-pjax' => "0",
            //                     'data-key' => $model->id_layanan,
            //                     'data-target' => "#myModal",
            //                     'data-toggle' => "modal",
            //                     'data-title' => "Pemeriksaan Okupasi"
            //                 ]
            //             );
            //         },
            //     ],
            // ],
            // ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
        ],
        'summaryOptions' => ['class' => 'summary mb-2'],
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager',
        ]
    ]); ?>

    <?php Pjax::end(); ?>
</div>