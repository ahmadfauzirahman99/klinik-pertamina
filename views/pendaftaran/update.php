<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pendaftaran */

$this->title = 'Update Pendaftaran: ' . $model->id_pendaftaran;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pendaftaran, 'url' => ['view', 'id' => $model->id_pendaftaran]];
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