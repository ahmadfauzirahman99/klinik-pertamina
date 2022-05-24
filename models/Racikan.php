<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "racikan".
 *
 * @property int $id_racikan
 * @property string $no_daftar
 * @property string $no_rekam_medik
 * @property string $created_at
 * @property int|null $created_by
 * @property string $updated_at
 * @property string|null $update_by
 * @property float $total_harga
 * @property float $total_bayar
 * @property int $id_poli
 * @property int $id_dokter
 * @property float|null $diskon_persen
 * @property float|null $diskon_total
 * @property string|null $keterangan
 * @property float|null $tuslah
 * @property string|null $tanggal
 */
class Racikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'racikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_daftar', 'no_rekam_medik', 'total_harga', 'total_bayar', 'id_poli', 'id_dokter'], 'required'],
            [['created_at', 'updated_at', 'tanggal'], 'safe'],
            [['created_by', 'id_poli', 'id_dokter','tuslah'], 'integer'],
            [['total_harga', 'total_bayar', 'diskon_persen', 'diskon_total'], 'number'],
            [['no_daftar', 'no_rekam_medik'], 'string', 'max' => 20],
            [['update_by', 'keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_racikan' => 'Id Racikan',
            'no_daftar' => 'No Daftar',
            'no_rekam_medik' => 'No Rekam Medik',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'update_by' => 'Update By',
            'total_harga' => 'Total Harga',
            'total_bayar' => 'Total Bayar',
            'id_poli' => 'Id Poli',
            'id_dokter' => 'Id Dokter',
            'diskon_persen' => 'Diskon Persen',
            'diskon_total' => 'Diskon Total',
            'keterangan' => 'Keterangan',
            'tuslah' => 'Tuslah',
            'tanggal' => 'Tanggal',
        ];
    }

    public function getRacikanDetail()
    {
        return $this->hasMany(RacikanDetail::className(), ['id_racikan' => 'id_racikan']);
    }
}
