<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_merk".
 *
 * @property int $id
 * @property string $nama
 * @property string $waktu_update
 */
class Merk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_merk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['waktu_update'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['nama'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'waktu_update' => 'Waktu Update',
        ];
    }
}
