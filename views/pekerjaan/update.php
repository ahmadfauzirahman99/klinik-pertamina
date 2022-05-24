<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */

$this->title = 'Update Pekerjaan: ' . $model->nama_pekerjaan;
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_pekerjaan, 'url' => ['view', 'id' => $model->id_pekerjaan]];
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