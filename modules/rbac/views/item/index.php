<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\rbac\components\RouteRule;
use app\modules\rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\rbac\models\searchs\AuthItem */
/* @var $context app\modules\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body">
                    <p>
                        <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-sm table-bordered table-hover table-list-item'
                        ],
                        'filterModel' => $searchModel,
                        'columns' => [

                            [
                                'contentOptions' => ['style' => 'text-align:center;'],
                                'headerOptions' => ['style' => 'text-align:center;'],
                                'class' => 'yii\grid\SerialColumn'
                            ],
                            [
                                'contentOptions' => ['style' => 'text-align:center;'],
                            'headerOptions' => ['style' => 'text-align:center;'],
                                'attribute' => 'name',
                                'label' => Yii::t('rbac-admin', 'Name'),
                            ],
                            // [
                            //     'attribute' => 'ruleName',
                            //     'label' => Yii::t('rbac-admin', 'Rule Name'),
                            //     'filter' => $rules
                            // ],
                            // [
                            //     'attribute' => 'description',
                            //     'label' => Yii::t('rbac-admin', 'Description'),
                            // ],
                            [
                                'class' => 'app\components\ActionColumn',
                                'contentOptions' => ['style' => 'text-align:center']
                            ],
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>