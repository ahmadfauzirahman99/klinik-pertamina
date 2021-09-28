<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran".
 *
 * @property string $id_pendaftaran
 * @property string $kode_pasien
 * @property string $tgl_masuk
 * @property string|null $tgl_keluar
 * @property string|null $id_kiriman
 * @property string|null $id_cara_bayar
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $updated_by
 * @property string|null $updated_at
 * @property string|null $is_delete
 * @property string|null $type
 */
class Pendaftaran extends \yii\db\ActiveRecord
{
    const MOBILE = 'MOBILE';
    const WEB = 'WEB BASE';

    public $tgl_timeline;
    public $id_kiriman_detail;
    public $id_cara_bayar_master;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pendaftaran', 'kode_pasien'], 'required'],
            [['tgl_masuk', 'tgl_keluar', 'created_at', 'updated_at'], 'safe'],
            [['id_pendaftaran'], 'string', 'max' => 150],
            [['kode_pasien', 'id_kiriman', 'id_cara_bayar', 'created_by', 'updated_by', 'is_delete', 'type'], 'string', 'max' => 100],
            [['id_pendaftaran'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pendaftaran' => 'No. Daftar',
            'kode_pasien' => 'No. RM',
            'tgl_masuk' => 'Tgl Masuk',
            'tgl_keluar' => 'Tgl Keluar',
            'id_kiriman' => 'Kiriman Dari',
            'id_cara_bayar' => 'Cara Bayar',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_delete' => 'Is Delete',
            'type' => 'Type',
        ];
    }

    public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekam_medik' => 'kode_pasien']);
    }

    public function getLayanan()
    {
        return $this->hasOne(Layanan::className(), ['registrasi_kode' => 'id_pendaftaran']);
    }

    public function getResep()
    {
        return $this->hasOne(Resep::className(), [
            'no_daftar' => 'id_pendaftaran',
            'no_rm' => 'kode_pasien',
        ]);
    }

    public function getPenunjang()
    {
        return $this->hasOne(OrderLab::className(), [
            'no_daftar' => 'id_pendaftaran',
            'no_rekam_medik' => 'kode_pasien',
        ]);
    }
}
