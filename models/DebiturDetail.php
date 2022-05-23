<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debitur_detail".
 *
 * @property int $id_debitur_kode
 * @property string $debitur_kode
 * @property string $nama
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property bool $aktif
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class DebiturDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debitur_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['debitur_kode', 'nama'], 'required'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['aktif'], 'boolean'],
            [['debitur_kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_debitur_kode' => 'Id Debitur Kode',
            'debitur_kode' => 'Debitur Kode',
            'nama' => 'Nama',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'aktif' => 'Aktif',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }
}
