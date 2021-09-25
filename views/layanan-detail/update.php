<?php

/* @var $this yii\web\View */
/* @var $model app\models\LayananDetail */

$this->title = 'Update Layanan Detail: ' . $model->id_layanan_detail;
$this->params['breadcrumbs'][] = ['label' => 'Layanan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_layanan_detail, 'url' => ['view', 'id' => $model->id_layanan_detail]];
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