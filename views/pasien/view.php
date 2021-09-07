<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_patient], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_patient], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id_patient',
                            'no_identitas',
                            'no_rekam_medik',
                            'no_kepesertaan',
                            'nama_lengkap',
                            'jenis_kelamin',
                            'alamat_lengkap:ntext',
                            'tempat_lahir',
                            'tanggal_lahir',
                            // 'kel',
                            // 'kec',
                            // 'kab',
                            'no_tlp_pasien',
                            'agama',
                            'status_perkawinan',
                            'pendidikan_terakhir',
                            'pekerjaan_terakhir',
                            'profesi',
                            'kewenegaraan',
                            'cara_pembayaran',
                            'nama_penanggung_jawab',
                            'is_penanggung_jawab',
                            'hubungan_dengan_pasien',
                            'no_telp',
                            'rt',
                            'rw',
                            // 'crt_by',
                            'anak_keberapa',
                            'nama_ayah',
                            'nama_ibu',
                          
                            'status_pasien',
                            'foto:ntext',
                            'foto_ktp:ntext',
                            'status_pekerjaan',
                            // 'crt',
                            // 'upd',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>