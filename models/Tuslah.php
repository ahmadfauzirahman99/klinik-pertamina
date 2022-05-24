<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tuslah".
 *
 * @property int $id_tuslah
 * @property string $no_rm
 * @property string $no_daftar
 * @property string $tanggal
 * @property string $jam
 * @property int|null $id_poli
 * @property int|null $id_dokter
 * @property int|null $id_racikan
 * @property int|null $total_tuslah
 */
class Tuslah extends \yii\db\ActiveRecord
{

    public $nama_pasien;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tuslah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_rm', 'no_daftar', 'tanggal', 'jam','total_tuslah'], 'required'],
            [['tanggal', 'jam', 'total_biaya_racikan'], 'safe'],
            [['id_poli', 'id_dokter', 'id_racikan'], 'integer'],
            [['no_rm', 'no_daftar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tuslah' => 'Id Tuslah',
            'no_rm' => 'No Rm',
            'no_daftar' => 'No Daftar',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'id_poli' => 'Id Poli',
            'id_dokter' => 'Id Dokter',
            'id_racikan' => 'Id Racikan',
            'total_biaya_racikan' => 'total_biaya_racikan',
        ];
    }

    public function getRacikan()
    {
        return $this->hasMany(Racikan::className(), ['tuslah' => 'id_tuslah']);
    }
}
