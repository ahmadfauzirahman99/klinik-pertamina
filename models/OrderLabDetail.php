<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_lab_detail".
 *
 * @property int $id_order_lab_detail
 * @property int|null $id_order_lab
 * @property int $item_pemeriksaan
 * @property float $jumlah
 * @property float $harga_tindakan
 * @property float $subtotal
 * @property string|null $catatan
 * @property int|null $is_deleted
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 */
class OrderLabDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_lab_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order_lab', 'item_pemeriksaan', 'is_deleted'], 'integer'],
            [['item_pemeriksaan', 'jumlah', 'harga_tindakan', 'subtotal'], 'required'],
            [['jumlah', 'harga_tindakan', 'subtotal'], 'number'],
            [['catatan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order_lab_detail' => 'Id Order Lab Detail',
            'id_order_lab' => 'Id Order Lab',
            'item_pemeriksaan' => 'Item Pemeriksaan',
            'jumlah' => 'Jumlah',
            'harga_tindakan' => 'Harga Tindakan',
            'subtotal' => 'Subtotal',
            'catatan' => 'Catatan',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getItem()
    {
        return $this->hasOne(ItemLab::className(), ['id_item_lab' => 'item_pemeriksaan']);
    }
}