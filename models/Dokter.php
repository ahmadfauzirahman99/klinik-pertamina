<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_dokter".
 *
 * @property string $id_dokter
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $nama_dokter
 * @property string $gelar_depan
 * @property string|null $gelar_belakang
 * @property string $alamat
 * @property string $telepon
 * @property string $handphone
 * @property string $jenis_kelamin
 */
class Dokter extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_dokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id_dokter', 'nama_dokter', 'gelar_depan', 'alamat', 'handphone'], 'required'],
            [['nama_dokter', 'gelar_depan', 'alamat', 'handphone'], 'required'],
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat', 'jenis_kelamin'], 'string'],
            [['id_dokter'], 'string', 'max' => 15],
            [['nama_dokter', 'gelar_depan', 'gelar_belakang', 'alamat'], 'string', 'max' => 200],
            [['telepon', 'handphone'], 'string', 'max' => 30],
            [['id_dokter'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dokter' => 'Kode Dokter',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'nama_dokter' => 'Nama Dokter',
            'gelar_depan' => 'Gelar Depan',
            'gelar_belakang' => 'Gelar Belakang',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'handphone' => 'Handphone',
            'jenis_kelamin' => 'Jenis Kelamin',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DokterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DokterQuery(get_called_class());
    }

    public function setKodeDokter()
    {
        $last_id_dokter = Self::find()->select('id_dokter')->orderBy(['id_dokter' => SORT_DESC])->one();
        $int_id_dokter = intval(substr($last_id_dokter->id_dokter, 1));
        $this->id_dokter = 'D' . sprintf('%03s', $int_id_dokter + 1);
    }
}
