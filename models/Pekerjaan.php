<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pekerjaan".
 *
 * @property int $id_pekerjaan
 * @property string $nama_pekerjaan
 * @property int $aktif
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pekerjaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pekerjaan'], 'required'],
            [['aktif'], 'integer'],
            [['nama_pekerjaan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pekerjaan' => 'Id Pekerjaan',
            'nama_pekerjaan' => 'Nama Pekerjaan',
            'aktif' => 'Aktif',
        ];
    }
}
