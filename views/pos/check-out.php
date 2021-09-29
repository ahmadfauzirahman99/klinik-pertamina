<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-24 17:38:03 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 23:37:06
 */

use app\components\DynamicFormWidget;
use app\components\HelperFormat;
use app\components\number\KyNumber;
use app\models\DebiturDetail;
use app\models\Dokter;
use app\models\Layanan;
use app\models\Pekerjaan;
use app\models\Poli;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;


$this->title = 'Point Of Service (POS)';

$pendidikan  = ['Tidak Sekolah' => 'Tidak Sekolah', 'SD' => 'SD', 'SMP/sederajat' => 'SMP/sederajat', 'SMA sederajat' => 'SMA sederajat', 'D3/D4' => 'D3/D4', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3', 'S1 Profesi' => 'S1 Profesi', 'S2 Profesi' => 'S2 Profesi', 'S3 Profesi' => 'S3 Profesi'];
$pekerjaan = ArrayHelper::map(Pekerjaan::find()->orderBy('nama_pekerjaan ASC')->all(), 'id_pekerjaan', 'nama_pekerjaan');


?>

<style>
    .teks-kecil {
        font-size: 0.8rem;
    }

    form .col-form-label-sm {
        font-size: 10.5px;
    }

    form .col-form-label-sm,
    form .form-group {
        margin-bottom: 0.15rem;
    }

    .form-options-item td {
        padding: 2px 2px 0px 2px;
    }

    .tabel-total-biaya {
        text-transform: uppercase;
    }

    .tabel-total-biaya {
        border-collapse: collapse;
    }

    .tabel-total-biaya th,
    .tabel-total-biaya td {
        border: 1px solid #aeb0b3;
    }

    .tabel-total-biaya th {
        padding: 3px;
    }

    .tabel-total-biaya td {
        padding: 1px;
    }

    .tabel-total-biaya tbody th .form-group,
    .tabel-total-biaya tbody td .form-group,
    .tabel-total-biaya tfoot th .form-group,
    .tabel-total-biaya tfoot td .form-group {
        margin-bottom: 0px;
    }

    .tabel-total-biaya input {
        font-family: "Lato", sans-serif;
        font-weight: 700 !important;
    }

    #accordion .card-body {
        padding: 5px;
    }

    #accordion th {
        padding: 1px 4px 1px 4px;
    }

    #accordion td {
        padding: 1px 4px 1px 4px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs">
                        <?= $this->render('form-wizard', ['model' => '']) ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" style="padding-right: 2px;">
                            <div class="card" style="border: solid 1px #c7c9cb;">
                                <div class="card-header">
                                    <i class="fas fa-user-injured fa-md"></i> &nbsp; Informasi Pasien
                                </div>
                                <div class="card-body">
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'form-checkout',
                                        'layout' => 'horizontal',
                                        // 'action' => ['/pos/obat'],
                                        'fieldConfig' => [
                                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                            'horizontalCssClasses' => [
                                                'label' => 'col-sm-4 col-form-label-sm',
                                                'wrapper' => 'col-sm-8',
                                                'error' => '',
                                                'hint' => '',
                                            ],
                                        ],
                                    ]); ?>

                                    <?php
                                    $url = Url::to(['api-internal/cari-rm']);

                                    echo $form->field($model, "no_rm")->widget(Select2::classname(), [

                                        'options' => [
                                            'placeholder' => 'Ketik No. RM / Nama Pasien...',
                                        ],
                                        'initValueText' => $model->getPasien($model->no_rm)->no_rekam_medik ?? null,
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                            'minimumInputLength' => 3,
                                            'dropdownAutoWidth' => true,
                                            'language' => [
                                                'errorLoading' => new JsExpression('function () { 
                                                        return "Menunggu hasil..."; 
                                                    }'),
                                                'inputTooShort' => new JsExpression('function () {
                                                        return "Minimal 3 karakter...";
                                                    }'),
                                                'searching' => new JsExpression('function() {
                                                        return "Mencari...";
                                                    }'),
                                            ],
                                            'ajax' => [
                                                'url' => $url,
                                                'dataType' => 'json',
                                                'data' => new JsExpression('function(params) { 
                                                return {
                                                    q:params.term, 
                                                    tanggal:$("#resep-tanggal").val()
                                                }; 
                                            }'),
                                                'delay' => 250,
                                                'cache' => true,
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function(data) { 
                                                let warnaInfoStok = data.stok == 0 ? "danger" : "success"
                                                return (data.loading) ?
                                                data.text :
                                                `<div class="row"> 
                                                    <div class="col-sm-6">
                                                        <strong>${data.nama}</strong> <br>
                                                        ${data.no_rm}
                                                    </div>
                                                    <div class="col-sm-2">
                                                        ${data.nama_poli}
                                                    </div>
                                                    <div class="col-sm-4">
                                                        ${data.tgl_masuk}
                                                    </div>
                                                </div>`
                                            }'),
                                            'templateSelection' => new JsExpression('function (data) { return data.no_rm ? data.no_rm : data.text; }'),
                                        ],
                                        'pluginEvents' => [
                                            "select2:select" => new JsExpression('function(e) { 
                                                let pasien = e.params.data
                                                console.log(pasien)
                                                window.open(baseUrl + "/pos/check-out" + "?reg=" + pasien.no_daftar + "&rm=" + pasien.no_rm, \'_self\');
                                            }'),
                                            "change" => new JsExpression('function(data) { 
                                                console.log("ganti")
                                            }'),
                                        ]
                                    ]);
                                    ?>

                                    <?= $form->field($pendaftaran, 'id_pendaftaran')->textInput([
                                        'maxlength' => true,
                                        'readonly' => true,
                                    ]) ?>

                                    <?= $form->field($pendaftaran, 'tgl_masuk')->textInput([
                                        'maxlength' => true,
                                        'readonly' => true,
                                    ]) ?>

                                    <?= $form->field($pendaftaran, 'id_cara_bayar')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(DebiturDetail::find()->all(), 'id_debitur_kode', 'nama'),
                                        'options' => ['placeholder' => 'Cara Bayar'],
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ]); ?>

                                    <hr>

                                    <div class="div-pasien">

                                        <?= $form->field($pasien, 'no_identitas')->textInput(['maxlength' => true, 'placeholder' => 'No. KTP/SIM/PASPORT']) ?>

                                        <?= $form->field($pasien, 'nama_lengkap')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap']) ?>

                                        <?= $form->field($pasien, 'jenis_kelamin')->dropDownList(['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan',], ['prompt' => 'Pilih Jenis Kelamin']) ?>

                                        <?= $form->field($pasien, 'alamat_lengkap')->textarea(['rows' => 2, 'placeholder' => 'Alamat Lengkap']) ?>
                                        <?= $form->field($pasien, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>
                                        <?= $form->field($pasien, 'tanggal_lahir')->widget(DatePicker::classname(), [
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
                                        <?php $form->field($pasien, 'kel')->textInput() ?>

                                        <?php $form->field($pasien, 'kec')->textInput() ?>

                                        <?php $form->field($pasien, 'kab')->textInput() ?>

                                        <div id="accordion">
                                            <div class="card" style="-webkit-box-shadow: none; box-shadow: none; margin-top: 8px;">
                                                <div class="card-header" id="headingSelengkapnya">
                                                    <h6 class="m-0">
                                                        <a href="#collapseSelengkapnya" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSelengkapnya">
                                                            Selengkapnya...
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseSelengkapnya" class="collapse" aria-labelledby="headingSelengkapnya" data-parent="#accordion" style="">
                                                    <div class="card-body" style="padding-top: 4px; padding-left: 0px; padding-right: 0px;">

                                                        <?= $form->field($pasien, 'agama')->dropDownList(['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katholik' => 'Katholik', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Lain-Lain' => 'Lain-Lain',], ['prompt' => 'Pilih Agama']) ?>

                                                        <?= $form->field($pasien, 'status_perkawinan')->dropDownList(['Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', 'Janda' => 'Janda', 'Duda' => 'Duda',], ['prompt' => 'Pilih Status Perkawanin']) ?>

                                                        <?= $form->field($pasien, 'pendidikan_terakhir')->dropdownList($pendidikan, ['prompt' => 'Pilih Pendidikan']) ?>
                                                        <?= $form->field($pasien, 'status_pekerjaan')->dropdownList(['Bekerja' => 'Bekerja', 'Tidak Bekerja' => 'Tidak Bekerja'], ['prompt' => 'Status Bekerja']) ?>

                                                        <?= $form->field($pasien, 'pekerjaan_terakhir')->dropdownList($pekerjaan, ['prompt' => 'Pilih Pekerjaan']) ?>

                                                        <?= $form->field($pasien, 'profesi')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Profesi Pekerjaan']) ?>

                                                        <?= $form->field($pasien, 'kewenegaraan')->dropDownList(['WNI' => 'WNI', 'WNA' => 'WNA',], ['prompt' => 'Pilih Status Kewenegaraan']) ?>

                                                        <?php $form->field($pasien, 'cara_pembayaran')->textInput() ?>


                                                        <?= $form->field($pasien, 'rt')->textInput(['maxlength' => true, 'placeholder' => 'Masukan RT']) ?>

                                                        <?= $form->field($pasien, 'rw')->textInput(['maxlength' => true, 'placeholder' => 'Masukan RW']) ?>


                                                        <?= $form->field($pasien, 'anak_keberapa')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Anak Keberapa Pasien']) ?>


                                                        <?= $form->field($pasien, 'status_pasien')->textInput(['maxlength' => true]) ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7" style="padding-left: 2px;">
                            <div class="card" style="border: solid 1px #c7c9cb;">
                                <div class="card-header">
                                    <i class="fas fa-file-invoice-dollar fa-md"></i> &nbsp; Biaya
                                </div>
                                <div class="card-body">
                                    <table class="tabel-total-biaya" style="width: 100%;" border="2">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" style="text-align: center; vertical-align: middle;">Rekapitulasi</th>
                                                <th style="text-align: center;">Total Biaya</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="4" style="text-align: center; vertical-align: middle; border-top:1.5px solid #363636;">Biaya</th>
                                                <th style="text-align: center; border-top:1.5px solid #363636;">Registrasi</th>
                                                <td style="border-top:1.5px solid #363636;">
                                                    <?php
                                                    echo $form->field($model, 'biaya_registrasi', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Tindakan</th>
                                                <td>
                                                    <?php
                                                    echo $form->field($model, 'biaya_tindakan', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Obat</th>
                                                <td>
                                                    <?php
                                                    echo $form->field($model, 'biaya_obat', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Penunjang</th>
                                                <td>
                                                    <?php
                                                    echo $form->field($model, 'biaya_penunjang', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" style="text-align: center; border-top: 1.5px solid #363636;">Total Biaya</th>
                                                <td style="border-top:1.5px solid #363636;">
                                                    <?php
                                                    echo $form->field($model, 'total_biaya', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" style="text-align: center;">Sudah Dibayar</th>
                                                <td>
                                                    <?php
                                                    echo $form->field($model, 'sudah_dibayar', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" style="text-align: center;">Sisa Pembayaran</th>
                                                <td>
                                                    <?php
                                                    echo $form->field($model, 'sisa_pembayaran', [
                                                        'template' => '<div class="col-sm-12">{input}</div>'
                                                    ])->widget(KyNumber::className(), ['displayOptions' => [
                                                        'class' => 'form-control form-control-sm text-right',
                                                        'style' => 'font-size: 1rem; font-weight: 900; cursor: no-drop;',
                                                        'readonly' => true,
                                                    ]])->label(false);
                                                    ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div style="margin-top: 10px;">
                                        TERBILANG
                                        <input value="<?= strtoupper(HelperFormat::terbilang($model->sisa_pembayaran)) ?> RUPIAH" type="text" class="form-control" style="font-size: 0.8rem; font-weight: 900; cursor: no-drop;" readonly>
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <div id="accordion">
                                            <div class="card">`
                                                <div class="card-header" id="headingTindakan">
                                                    <h6 class="m-0">
                                                        <a href="#rincianTindakan" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="rincianTindakan">
                                                            Rincian Tindakan &nbsp; <?php $getLayananDetail = (isset($tindakan->layananDetail)) ? $tindakan->getLayananDetail()->count() : 0;
                                                                                    if ($getLayananDetail != 0) echo '<span class="badge badge-danger badge-pill">' . $getLayananDetail . '</span>'; ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="rincianTindakan" class="collapse" aria-labelledby="headingTindakan" data-parent="#accordion" style="">
                                                    <div class="card-body table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="teks-kecil text-center bg-info text-white" style="width: 5%;">#</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Tindakan</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Jenis</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Keterangan</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Jumlah</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Harga</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ((isset($tindakan->layananDetail))) {
                                                                    foreach ($tindakan->layananDetail as $key => $value) {
                                                                        echo '
                                                                        <tr>
                                                                            <td class="teks-kecil text-center">' . ($key + 1) . '</td>
                                                                            <td class="teks-kecil">' . $value->tindakan->nama_tindakan . '</td>
                                                                            <td class="teks-kecil">' . $value->status . '</td>
                                                                            <td class="teks-kecil">' . $value->keterangan . '</td>
                                                                            <td class="teks-kecil text-center">' . Yii::$app->formatter->asDecimal($value->jumlah) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->harga_jual) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->subtotal) . '</td>
                                                                        </tr>
                                                                    ';
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingResep">
                                                    <h6 class="m-0">
                                                        <a href="#rincianResep" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="rincianResep">
                                                            Rincian Resep &nbsp; <?php $getResepDetail = (isset($resep->resepDetail)) ? $resep->getResepDetail()->count() : 0;
                                                                                    if ($getResepDetail != 0) echo '<span class="badge badge-danger badge-pill">' . $getResepDetail . '</span>'; ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="rincianResep" class="collapse" aria-labelledby="headingResep" data-parent="#accordion" style="">
                                                    <div class="card-body table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="teks-kecil text-center bg-info text-white" style="width: 5%;">#</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Barang</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Keterangan</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Dosis</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Jumlah</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Harga</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ((isset($resep->resepDetail))) {
                                                                    foreach ($resep->resepDetail as $key => $value) {
                                                                        echo '
                                                                        <tr>
                                                                            <td class="teks-kecil text-center">' . ($key + 1) . '</td>
                                                                            <td class="teks-kecil">' . $value->barang->nama_barang . '</td>
                                                                            <td class="teks-kecil">' . $value->keterangan . '</td>
                                                                            <td class="teks-kecil">' . $value->dosis . '</td>
                                                                            <td class="teks-kecil text-center">' . Yii::$app->formatter->asDecimal($value->jumlah) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->harga_jual) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->subtotal) . '</td>
                                                                        </tr>
                                                                    ';
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingPenunjang">
                                                    <h6 class="m-0">
                                                        <a href="#rincianPenunjang" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="rincianPenunjang">
                                                            Rincian Penunjang &nbsp; <?php $getLabDetail = (isset($penunjang->labDetail)) ? $penunjang->getLabDetail()->count() : 0;
                                                                                        if ($getLabDetail != 0) echo '<span class="badge badge-danger badge-pill">' . $getLabDetail . '</span>'; ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="rincianPenunjang" class="collapse" aria-labelledby="headingPenunjang" data-parent="#accordion" style="">
                                                    <div class="card-body table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="teks-kecil text-center bg-info text-white" style="width: 5%;">#</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Tindakan</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Jumlah</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Harga</th>
                                                                    <th class="teks-kecil text-center bg-info text-white">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ((isset($penunjang->labDetail))) {
                                                                    foreach ($penunjang->labDetail as $key => $value) {
                                                                        echo '
                                                                        <tr>
                                                                            <td class="teks-kecil text-center">' . ($key + 1) . '</td>
                                                                            <td class="teks-kecil">' . $value->item->nama_item . '</td>
                                                                            <td class="teks-kecil text-center">' . Yii::$app->formatter->asDecimal($value->jumlah) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->harga_tindakan) . '</td>
                                                                            <td class="teks-kecil text-right">' . Yii::$app->formatter->asDecimal($value->subtotal) . '</td>
                                                                        </tr>
                                                                    ';
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->registerJs(<<<JS
    $('.div-pasien input, .div-pasien textarea').prop("readonly",true);
    $('.div-pasien select').prop("disabled",true);
JS);
