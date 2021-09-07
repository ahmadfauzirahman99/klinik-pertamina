<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_poli".
 *
 * @property int $id_poli
 * @property string $nama_poli
 * @property int $status
 */
class Poli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_poli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_poli'], 'required'],
            [['status'], 'integer'],
            [['nama_poli'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_poli' => 'Id Poli',
            'nama_poli' => 'Nama Poli',
            'status' => 'Status',
        ];
    }
}
