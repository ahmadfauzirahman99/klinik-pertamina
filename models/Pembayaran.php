<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id_pembayaran
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $no_daftar
 * @property string $no_rm
 * @property string $tanggal
 * @property string $jam
 * @property float $total_harga
 * @property float $diskon_persen
 * @property float $diskon_total
 * @property float $total_bayar
 * @property string $json_detail
 */
class Pembayaran extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'tanggal', 'jam'], 'safe'],
            [['riwayat', 'json_detail'], 'string'],
            [['no_daftar', 'no_rm', 'tanggal', 'jam', 'json_detail'], 'required'],
            [['total_harga', 'diskon_persen', 'diskon_total', 'total_bayar'], 'number'],
            [['no_daftar', 'no_rm'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pembayaran' => 'Id Pembayaran',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'no_daftar' => 'No Daftar',
            'no_rm' => 'No Rm',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'total_harga' => 'Total Harga',
            'diskon_persen' => 'Diskon Persen',
            'diskon_total' => 'Diskon Total',
            'total_bayar' => 'Total Bayar',
            'json_detail' => 'Json Detail',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PembayaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PembayaranQuery(get_called_class());
    }


    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::className(), [
            'id_pendaftaran' => 'no_daftar',
            'kode_pasien' => 'no_rm',
        ]);
    }
}
