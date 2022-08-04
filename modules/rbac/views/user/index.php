<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\rbac\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rbac\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'username',
                            'verif',
                           
                            // [
                            //     'class' => 'yii\grid\ActionColumn',
                            //     'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                            //     'buttons' => [
                            //         'activate' => function ($url, $model) {
                            //             if ($model->status == 'Aktif') {
                            //                 return 'OK';
                            //             }
                            //             $options = [
                            //                 'title' => Yii::t('rbac-admin', 'Activate'),
                            //                 'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //                 'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            //                 'data-method' => 'post',
                            //                 'data-pjax' => '0',
                            //             ];
                            //             return Html::a('<span class="fas fa-check"></span>', $url, $options);
                            //         }
                            //     ]
                            // ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>