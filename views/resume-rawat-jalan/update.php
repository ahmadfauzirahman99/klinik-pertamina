<?php

/* @var $this yii\web\View */
/* @var $model app\models\ResumeRawatJalan */

$this->title = 'Update Resume Rawat Jalan: ' . $model->id_resume_rawat_jalan;
$this->params['breadcrumbs'][] = ['label' => 'Resume Rawat Jalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_resume_rawat_jalan, 'url' => ['view', 'id' => $model->id_resume_rawat_jalan]];
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