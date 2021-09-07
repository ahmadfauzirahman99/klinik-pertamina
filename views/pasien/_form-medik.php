

<?php if (!$model->isNewRecord) { ?>
<?= $form->field($model, 'no_rekam_medik')->textInput(['maxlength' => true, 'placeholder' => 'No Rekam Medik', 'readonly' => $model->isNewRecord ? false : true]) ?>
<?php  } ?>
<?= $form->field($model, 'no_kepesertaan')->textInput(['maxlength' => true, 'placeholder' => 'No Kartu Anggota PT/BPJS']) ?>
<?= $form->field($model, 'no_tlp_pasien')->textInput(['maxlength' => true, 'placeholder' => 'No Telepon Pasien']) ?>
