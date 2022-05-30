<?php

/* @var $this yii\web\View */
/* @var $model app\models\Dokter */

$this->title = 'Update Dokter: ' . $model->nama_dokter;
$this->params['breadcrumbs'][] = ['label' => 'Dokter', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_dokter, 'url' => ['view', 'id' => $model->id_dokter]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model
            ]) ?>
        </div>
    </div>
    <!--.card-->
</div>