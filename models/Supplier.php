<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_supplier".
 *
 * @property int $id_supplier
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $nama_supplier
 * @property string $kontak_person
 * @property string $telepon
 * @property string $alamat
 */
class Supplier extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_supplier';
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
            [['nama_supplier', 'kontak_person', 'telepon', 'alamat'], 'required'],
            [['nama_supplier', 'alamat'], 'string', 'max' => 200],
            [['kontak_person'], 'string', 'max' => 100],
            [['telepon'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_supplier' => 'Id Supplier',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'nama_supplier' => 'Nama Supplier',
            'kontak_person' => 'Kontak Person',
            'telepon' => 'Telepon',
            'alamat' => 'Alamat',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }
}
