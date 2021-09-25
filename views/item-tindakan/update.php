<?php

/* @var $this yii\web\View */
/* @var $model app\models\ItemTindakan */

$this->title = 'Update Item Tindakan: ' . $model->id_item_tindakan;
$this->params['breadcrumbs'][] = ['label' => 'Item Tindakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_item_tindakan, 'url' => ['view', 'id' => $model->id_item_tindakan]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>