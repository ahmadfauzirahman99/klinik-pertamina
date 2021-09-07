<?php

/* @var $this yii\web\View */
/* @var $model app\models\Satuan */

$this->title = 'Update Satuan: ' . $model->id_satuan;
$this->params['breadcrumbs'][] = ['label' => 'Satuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_satuan, 'url' => ['view', 'id' => $model->id_satuan]];
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