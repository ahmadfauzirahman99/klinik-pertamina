<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_dosis".
 *
 * @property int $id_dosis
 * @property int|null $is_active
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $nama_dosis
 * @property string|null $keterangan
 */
class Dosis extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_dosis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active', 'created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat', 'keterangan'], 'string'],
            [['nama_dosis'], 'required'],
            [['nama_dosis'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dosis' => 'Id Dosis',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'nama_dosis' => 'Nama Dosis',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DosisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DosisQuery(get_called_class());
    }
}
