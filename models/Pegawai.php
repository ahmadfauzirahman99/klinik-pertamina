<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pegawai".
 *
 * @property int $id_pegawai
 * @property string|null $created_by
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_at
 * @property string $nama_pegawai
 * @property string $no_pegawai
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $jk
 * @property string $agama
 * @property string $status_pegawai
 * @property string $no_telp
 * @property string|null $foto
 * @property string|null $type
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'tgl_lahir'], 'safe'],
            [['updated_by', 'nama_pegawai', 'no_pegawai', 'tgl_lahir', 'tempat_lahir', 'jk', 'agama', 'status_pegawai', 'no_telp'], 'required'],
            [['jk', 'foto'], 'string'],
            [['created_by', 'updated_by', 'nama_pegawai', 'no_pegawai', 'tempat_lahir', 'agama', 'type'], 'string', 'max' => 100],
            [['status_pegawai'], 'string', 'max' => 10],
            [['no_telp'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'nama_pegawai' => 'Nama Pegawai',
            'no_pegawai' => 'No Pegawai',
            'tgl_lahir' => 'Tanggal Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'jk' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'status_pegawai' => 'Status Pegawai',
            'no_telp' => 'No Telp',
            'foto' => 'Foto',
            'type' => 'Jenis Pegawai',
        ];
    }
}
