<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\rbac\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
    'nama_lengkap',
    // [
    //     'attribute' => 'nama',
    //     // 'value' => function ($model) {
    //     //     return $model->pegawai->nama_lengkap;
    //     // },
    // ],
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'header' => 'Actions',
    'headerOptions' => ['style' => 'text-align:center'],
    'template' => '{view}'
];
?>
<div class="assignment-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card card-body">
                <h4 class="header-title m-t-0 m-b-10">Data User</h4>

                <p class="text-muted m-b-15 font-13">Menu Pemilihan Rule Untuk User</p>
                    <?php Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => [
                            'class' => 'table table-sm table-bordered table-hover table-list-item'
                        ],
                        'columns' => $columns,
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>