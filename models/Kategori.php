<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_kategori".
 *
 * @property int $id
 * @property string $nama
 * @property string $waktu_update
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_kategori';
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
