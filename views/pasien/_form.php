<?php

use app\models\Pekerjaan;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\bootstrap4\ActiveForm */

$pendidikan  = ['Tidak Sekolah' => 'Tidak Sekolah', 'SD' => 'SD', 'SMP/sederajat' => 'SMP/sederajat', 'SMA sederajat' => 'SMA sederajat', 'D3/D4' => 'D3/D4', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3', 'S1 Profesi' => 'S1 Profesi', 'S2 Profesi' => 'S2 Profesi', 'S3 Profesi' => 'S3 Profesi'];
$pekerjaan = ArrayHelper::map(Pekerjaan::find()->orderBy('nama_pekerjaan ASC')->all(), 'id_pekerjaan', 'nama_pekerjaan');
?>

<div class="pasien-form">


    <?= $form->field($model, 'no_identitas')->textInput(['maxlength' => true, 'placeholder' => 'No. KTP/SIM/PASPORT']) ?>
    <?= $form->field($model, 'no_kepesertaan')->textInput(['maxlength' => true, 'placeholder' => 'No Pensiunan'])->label('No. Pensiunan') ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap']) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan',], ['prompt' => 'Pilih Jenis Kelamin']) ?>

    <?= $form->field($model, 'alamat_lengkap')->textarea(['rows' => 2, 'placeholder' => 'Alamat Lengkap']) ?>
    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>
    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), [
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
    <?php $form->field($model, 'kel')->textInput() ?>
    <?php $form->field($model, 'kec')->textInput() ?>
    <?php $form->field($model, 'kab')->textInput() ?>
    <?= $form->field($model, 'agama')->dropDownList(['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katholik' => 'Katholik', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Lain-Lain' => 'Lain-Lain',], ['prompt' => 'Pilih Agama']) ?>
    <?= $form->field($model, 'status_perkawinan')->dropDownList(['Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', 'Janda' => 'Janda', 'Duda' => 'Duda',], ['prompt' => 'Pilih Status Perkawanin']) ?>
    <?= $form->field($model, 'pendidikan_terakhir')->dropdownList($pendidikan, ['prompt' => 'Pilih Pendidikan']) ?>
    <?= $form->field($model, 'status_pekerjaan')->dropdownList(['Bekerja' => 'Bekerja', 'Tidak Bekerja' => 'Tidak Bekerja'], ['prompt' => 'Status Bekerja']) ?>
    <?= $form->field($model, 'pekerjaan_terakhir')->dropdownList($pekerjaan, ['prompt' => 'Pilih Pekerjaan']) ?>
    <?= $form->field($model, 'profesi')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Profesi Pekerjaan']) ?>
    <?= $form->field($model, 'kewenegaraan')->dropDownList(['WNI' => 'WNI', 'WNA' => 'WNA',], ['prompt' => 'Pilih Status Kewenegaraan']) ?>
    <?php $form->field($model, 'cara_pembayaran')->textInput() ?>
    <?= $form->field($model, 'rt')->textInput(['maxlength' => true, 'placeholder' => 'Masukan RT']) ?>
    <?= $form->field($model, 'rw')->textInput(['maxlength' => true, 'placeholder' => 'Masukan RW']) ?>
    <?= $form->field($model, 'anak_keberapa')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Anak Keberapa Pasien']) ?>
    <?= $form->field($model, 'status_pasien')->dropDownList(['0' => 'Aktif','1'=>'Tidak Aktif'],['prompt'=>'Pilih Status Pasien']) ?>
    <?php $form->field($model, 'crt')->textInput() ?>
    <?php $form->field($model, 'is_penanggung_jawab')->textInput(['maxlength' => true]) ?>
    <?php $form->field($model, 'upd')->textInput() ?>
    <?php $form->field($model, 'crt_by')->textInput() ?>


</div>