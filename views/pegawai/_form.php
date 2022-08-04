<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\bootstrap4\ActiveForm */

if ($model->isNewRecord) {
    $noPegawai = date('Ymd') . rand(1, 100);
}else{
    $noPegawai = $model->no_pegawai;
}
?>
<style>
    #form .col-form-label {
        font-size: small;
    }

    #form .form-group {
        margin-bottom: 0.1rem;
    }
</style>
<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'layout' => 'horizontal']); ?>

    <?php $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
    <?php $form->field($model, 'created_at')->textInput() ?>
    <?php $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
    <?php $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'nama_pegawai')->textInput(['maxlength' => true, 'placeholder' => 'Nama Pegawai']) ?>

    <?= $form->field($model, 'no_pegawai')->textInput(['maxlength' => true, 'value' => $noPegawai, 'readonly' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Tanggal Lahir',
            'class' => 'form-control form-control-sm',

        ],
        'removeButton' => false,

        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>
    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

    <?= $form->field($model, 'jk')->dropDownList(['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan',], ['prompt' => 'Pilih Jenis Kelamin']) ?>

    <?= $form->field($model, 'agama')->dropDownList(['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Budha' => 'Budha'], ['prompt' => 'Pilih Agama']) ?>

    <?= $form->field($model, 'status_pegawai')->dropDownList(['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'], ['prompt' => 'Pilih Status Pegawai']) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Telepon']) ?>

    <?=
    $form->field($model, 'foto', [])->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
            'showCancel' => false,
            'initialPreview' => [
                $model->foto ? Url::to('@web/img/pegawai/' . $model->foto) : null
            ],
            'initialPreviewAsData' => true,
            'initialCaption' => $model->foto,
            'initialPreviewConfig' => [
                [
                    'caption' => $model->foto,
                    'showRemove' => true,
                    'url' => Url::to(['pegawai/hapus-foto']), // server delete action 
                    'key' => $model->id_pegawai,
                    'extra' => [
                        'jenis_foto' => 'foto',
                        'nama_file' => $model->foto
                    ]
                ],
            ],
            'overwriteInitial' => true,
            'maxFileSize' => 2800,
            'deleteUrl' => Url::to(['/site/file-upload']),
        ]
    ])->label('Foto Diri')
    ?>
    <?= $form->field($model, 'type')->dropdownList(['Dokter' => 'Dokter', 'Pegawai' => 'Pegawai'], ['prompt' => 'Jenis Pegawai']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan Pegawai', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>