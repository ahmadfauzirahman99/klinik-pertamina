<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_lab".
 *
 * @property int $id_lab
 * @property string $no_transaksi
 * @property int $poli_id
 * @property string $id_dokter
 * @property string|null $diagnosa
 * @property string|null $kondisi_sampel
 * @property string|null $catatan
 * @property string $no_rekam_medik
 * @property string $no_daftar
 * @property string $nama_pasien
 * @property string $tanggal
 * @property float $total_harga
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $updated_by
 * @property string|null $updated_at
 */
class OrderLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_transaksi', 'poli_id', 'id_dokter', 'no_rekam_medik', 'no_daftar', 'nama_pasien', 'tanggal', 'total_harga'], 'required'],
            [['poli_id'], 'integer'],
            [['diagnosa', 'catatan'], 'string'],
            [['tanggal', 'created_at', 'updated_at'], 'safe'],
            [['total_harga'], 'number'],
            [['no_transaksi', 'id_dokter', 'kondisi_sampel', 'no_rekam_medik', 'no_daftar', 'created_by', 'updated_by'], 'string', 'max' => 100],
            [['nama_pasien'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lab' => 'Id Lab',
            'no_transaksi' => 'No Transaksi',
            'poli_id' => 'Poli ID',
            'id_dokter' => 'Id Dokter',
            'diagnosa' => 'Diagnosa',
            'kondisi_sampel' => 'Kondisi Sampel',
            'catatan' => 'Catatan',
            'no_rekam_medik' => 'No Rekam Medik',
            'no_daftar' => 'No Daftar',
            'nama_pasien' => 'Nama Pasien',
            'tanggal' => 'Tanggal',
            'total_harga' => 'Total Harga',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
    public function getLabDetail()
    {
        return $this->hasMany(OrderLabDetail::className(), ['id_order_lab' => 'id_lab']);
    }
}