<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_lab".
 *
 * @property int $id_item_lab
 * @property string $nama_item
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string $updated_at
 * @property string|null $updated_by
 */
class ItemLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_item'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_item'], 'string', 'max' => 200],
            [['created_by', 'updated_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item_lab' => 'Id Item Lab',
            'nama_item' => 'Nama Item',
            'created_at' => 'Tanggal Buat',
            'created_by' => 'Created By',
            'updated_at' => 'Tanggal Update',
            'updated_by' => 'Updated By',
        ];
    }
}
