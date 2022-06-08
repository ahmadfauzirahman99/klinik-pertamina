<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "no_table".
 *
 * @property int $no_table
 * @property string|null $nm
 * @property string|null $next_number
 */
class NoTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'no_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm', 'next_number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_table' => 'No Table',
            'nm' => 'Nm',
            'next_number' => 'Next Number',
        ];
    }
}
