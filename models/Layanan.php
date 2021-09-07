<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "layanan".
 *
 * @property int $id_layanan
 * @property string $registrasi_kode
 * @property int|null $jenis_layanan
 * @property string $tgl_masuk
 * @property string|null $tgl_keluar
 * @property string|null $unit_kode
 * @property string|null $unit_asal_kode
 * @property int|null $unit_tujuan_kode
 * @property string|null $keterangan
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $status_layanan DAFTAR,DILAYANI,SELESAI,BATAL
 */
class Layanan extends \yii\db\ActiveRecord
{
    const DAFTAR = 'DAFTAR';
    const DILAYANI = 'DILAYANI';
    const SELESAI = 'SELESAI';
    const BATAL = 'BATAL';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'layanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registrasi_kode'], 'required'],
            [['jenis_layanan', 'unit_tujuan_kode', 'created_by', 'created_at', 'updated_by', 'deleted_by'], 'integer'],
            [['tgl_masuk', 'tgl_keluar', 'updated_at', 'deleted_at'], 'safe'],
            [['keterangan'], 'string'],
            [['registrasi_kode'], 'string', 'max' => 120],
            [['unit_kode', 'status_layanan'], 'string', 'max' => 100],
            [['unit_asal_kode'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_layanan' => 'Id Layanan',
            'registrasi_kode' => 'Registrasi Kode',
            'jenis_layanan' => 'Poli',
            'tgl_masuk' => 'Tanggal Masuk',
            'tgl_keluar' => 'Tanggal Keluar',
            'unit_kode' => 'Unit Kode',
            'unit_asal_kode' => 'Unit Asal',
            'unit_tujuan_kode' => 'Unit Tujuan',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'status_layanan' => 'Status Layanan',
        ];
    }

    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::className(), ['id_pendaftaran' => 'registrasi_kode']);
    }

    
    public function getUnit()
    {
        return $this->hasOne(Poli::className(), ['id_poli' => 'unit_tujuan_kode']);
    }
}
