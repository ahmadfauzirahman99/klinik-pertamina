<?php

/* @var $this yii\web\View */
/* @var $model app\models\Dosis */

$this->title = 'Update Dosis: ' . $model->id_dosis;
$this->params['breadcrumbs'][] = ['label' => 'Doses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dosis, 'url' => ['view', 'id' => $model->id_dosis]];
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