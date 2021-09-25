<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_tindakan".
 *
 * @property int $id_tindakan
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $nama_tindakan
 * @property string|null $keterangan
 * @property float $harga_jual
 */
class ItemTindakan extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_tindakan';
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
            [['nama_tindakan'], 'required'],
            [['harga_jual'], 'number'],
            [['nama_tindakan'], 'string', 'max' => 250],
            [['keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tindakan' => 'Id Item Tindakan',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'nama_tindakan' => 'Nama Tindakan',
            'keterangan' => 'Keterangan',
            'harga_jual' => 'Harga Jual',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ItemTindakanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemTindakanQuery(get_called_class());
    }
}
