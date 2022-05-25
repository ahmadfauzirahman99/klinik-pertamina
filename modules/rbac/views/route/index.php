<?php

use app\modules\rbac\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title = Yii::t('rbac-admin', 'Routes');
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="card-box">
    <div class="row">
        <div class="col-sm-10">
            <div class="input-group">
                <input id="inp-route" type="text" class="form-control" placeholder="<?= Yii::t('rbac-admin', 'New route(s)'); ?>">

            </div>

        </div>
        <div class="col-sm-2">
            <span class="input-group-btn">
                <?= Html::a(Yii::t('rbac-admin', 'Add') . $animateIcon, ['create'], [
                    'class' => 'btn btn-success btn-block',
                    'id' => 'btn-new',
                ]); ?>
            </span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-body">
                <div class="input-group">
                    <input class="form-control search" data-target="available" placeholder="<?= Yii::t('rbac-admin', 'Search for available'); ?>">
                    <span class="input-group-append">
                        <?= Html::a('<span class="fas fa-sync-alt"></span>', ['refresh'], [
                            'class' => 'btn btn-default',
                            'id' => 'btn-refresh',
                        ]); ?>
                    </span>
                </div>
                <select multiple size="20" class="form-control list" data-target="available"></select>
            </div>
        </div>
        <div class="col-sm-1 text-center">
            <br>
            <br>
            <br>
            <br>
            <?= Html::a('&gt;&gt;' . $animateIcon, ['assign'], [
                'class' => 'btn btn-success btn-assign',
                'data-target' => 'available',
                'title' => Yii::t('rbac-admin', 'Assign'),
            ]); ?> <br><br>
            <?= Html::a('&lt;&lt;' . $animateIcon, ['remove'], [
                'class' => 'btn btn-danger btn-assign',
                'data-target' => 'assigned',
                'title' => Yii::t('rbac-admin', 'Remove'),
            ]); ?>
        </div>
        <div class="col-sm-5">
            <div class="card card-body">
                <input class="form-control search" data-target="assigned" placeholder="<?= Yii::t('rbac-admin', 'Search for assigned'); ?>">
                <select multiple size="20" class="form-control list" data-target="assigned"></select>
            </div>
        </div>
    </div>

</div>