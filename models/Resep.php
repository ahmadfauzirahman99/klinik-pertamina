<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resep".
 *
 * @property int $id_resep
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
 * @property int $id_poli
 * @property string $id_dokter
 * @property string $tanggal
 * @property string $jam
 * @property int|null $is_retur
 * @property string|null $tanggal_retur
 * @property int|null $retur_by
 * @property float $total_harga
 * @property float $diskon_persen
 * @property float $diskon_total
 * @property float $total_bayar
 */
class Resep extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_poli', 'is_retur', 'retur_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'tanggal', 'jam', 'tanggal_retur'], 'safe'],
            [['riwayat'], 'string'],
            [['no_daftar', 'no_rm', 'id_poli', 'id_dokter', 'tanggal', 'jam'], 'required'],
            [['total_harga', 'diskon_persen', 'diskon_total', 'total_bayar'], 'number'],
            [['no_daftar', 'no_rm'], 'string', 'max' => 20],
            [['id_dokter'], 'string', 'max' => 100],

            ['nama_pasien', 'default', 'value' => '-'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_resep' => 'Id Resep',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'no_daftar' => 'No Daftar',
            'no_rm' => 'No. RM',
            'id_poli' => 'Poli',
            'id_dokter' => 'Dokter',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'is_retur' => 'Is Retur',
            'tanggal_retur' => 'Tanggal Retur',
            'retur_by' => 'Retur By',
            'total_harga' => 'Total Harga',
            'diskon_persen' => 'Diskon Persen',
            'diskon_total' => 'Diskon Total',
            'total_bayar' => 'Total Bayar',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ResepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResepQuery(get_called_class());
    }

    public function getResepDetail()
    {
        return $this->hasMany(ResepDetail::className(), ['id_resep' => 'id_resep']);
    }
}
