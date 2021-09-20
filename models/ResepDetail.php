<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resep_detail".
 *
 * @property int $id_resep_detail
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $id_barang
 * @property string|null $dosis
 * @property string|null $keterangan
 * @property float $harga_jual
 * @property float $jumlah
 * @property float $subtotal
 */
class ResepDetail extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resep_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat'], 'string'],
            [['id_barang'], 'required'],
            [['harga_jual', 'jumlah', 'subtotal'], 'number'],
            [['id_barang', 'dosis', 'keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_resep_detail' => 'Id Resep Detail',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'id_barang' => 'Barang',
            'dosis' => 'Dosis',
            'keterangan' => 'Keterangan',
            'harga_jual' => 'Harga Jual',
            'jumlah' => 'Jumlah',
            'subtotal' => 'Subtotal',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ResepDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResepDetailQuery(get_called_class());
    }
}
