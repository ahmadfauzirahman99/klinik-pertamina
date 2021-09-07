<?php

/* @var $this yii\web\View */
/* @var $model app\models\Poli */

$this->title = 'Update Poli: ' . $model->id_poli;
$this->params['breadcrumbs'][] = ['label' => 'Polis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_poli, 'url' => ['view', 'id' => $model->id_poli]];
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