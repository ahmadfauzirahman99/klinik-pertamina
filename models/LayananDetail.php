<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "layanan_detail".
 *
 * @property int $id_layanan_detail
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property int|null $id_layanan
 * @property int $id_tindakan
 * @property string|null $keterangan
 * @property float $harga_jual
 * @property float $jumlah
 * @property float $subtotal
 * @property string $status
 */
class LayananDetail extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'layanan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_layanan', 'id_tindakan'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat'], 'string'],
            [['id_tindakan', 'status'], 'required'],
            [['harga_jual', 'jumlah', 'subtotal'], 'number'],
            [['keterangan', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_layanan_detail' => 'Id Layanan Detail',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'id_layanan' => 'Id Layanan',
            'id_tindakan' => 'Id Tindakan',
            'keterangan' => 'Keterangan',
            'harga_jual' => 'Harga Jual',
            'jumlah' => 'Jumlah',
            'subtotal' => 'Subtotal',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LayananDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LayananDetailQuery(get_called_class());
    }

    public function getTindakan()
    {
        return $this->hasOne(ItemTindakan::className(), ['id_tindakan' => 'id_tindakan']);
    }
}
