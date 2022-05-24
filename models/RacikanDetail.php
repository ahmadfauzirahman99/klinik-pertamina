<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "racikan_detail".
 *
 * @property int $id_racikan_detail
 * @property string|null $no_rekam_medik
 * @property string|null $no_daftar
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $updated_by
 * @property string|null $updated_at
 * @property string|null $id_barang_racikan
 * @property string|null $keterangan
 * @property float|null $harga_jual
 * @property float|null $jumlah
 * @property float|null $subtotal
 * @property string|null $id_racikan
 * @property string|null $dosis
 * @property string|null $tanggal
 */
class RacikanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'racikan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['harga_jual', 'jumlah', 'subtotal'], 'safe'],
            [['tanggal'], 'safe'],
            [['no_rekam_medik', 'no_daftar', 'created_by', 'created_at', 'updated_by', 'updated_at', 'id_barang_racikan', 'keterangan', 'id_racikan', 'dosis'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_racikan_detail' => 'Id Racikan Detail',
            'no_rekam_medik' => 'No Rekam Medik',
            'no_daftar' => 'No Daftar',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'id_barang_racikan' => 'Id Barang',
            'keterangan' => 'Keterangan',
            'harga_jual' => 'Harga Jual',
            'jumlah' => 'Jumlah',
            'subtotal' => 'Subtotal',
            'id_racikan' => 'Id Racikan',
            'dosis' => 'Dosis',
            'tanggal' => 'Tanggal',
        ];
    }


    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id_barang' => 'id_barang_racikan']);
    }
}
