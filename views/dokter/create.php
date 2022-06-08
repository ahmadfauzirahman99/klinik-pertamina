<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dokter */

$this->title = 'Form Dokter';
$this->params['breadcrumbs'][] = ['label' => 'Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

            <!--.card-->
        </div>
    </div>
</div>