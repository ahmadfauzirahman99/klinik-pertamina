<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume_rawat_jalan".
 *
 * @property int $id_resume_rawat_jalan
 * @property int $no_rekam_medik
 * @property int $no_daftar
 * @property string|null $anamnesa
 * @property string $hasil_penunjang
 * @property string|null $diaganosa
 * @property string|null $therapy
 * @property string $created_at
 * @property string|null $created_by
 * @property string $updated_at
 * @property string|null $updated_by
 */
class ResumeRawatJalan extends \yii\db\ActiveRecord
{
    public $nama_pasien;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_rawat_jalan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_rekam_medik', 'no_daftar'], 'required'],
            [['no_daftar'], 'integer'],
            [['anamnesa', 'no_rekam_medik', 'hasil_penunjang', 'diaganosa', 'therapy'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_resume_rawat_jalan' => 'Id Resume Rawat Jalan',
            'no_rekam_medik' => 'No Rekam Medik',
            'no_daftar' => 'No Daftar',
            'anamnesa' => 'Anamnesa',
            'hasil_penunjang' => 'Hasil Penunjang',
            'diaganosa' => 'Diaganosa',
            'therapy' => 'Therapy',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
