<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-15 00:26:18 
 * @Last Modified by:   Dicky Ermawan S., S.T., MTA 
 * @Last Modified time: 2021-09-15 00:26:18 
 */


namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "satuan".
 *
 * @property int $id_satuan
 * @property int|null $is_active
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $nama_satuan
 * @property string|null $keterangan
 */
class Satuan extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_satuan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active', 'created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat', 'keterangan'], 'string'],
            [['nama_satuan'], 'required'],
            [['nama_satuan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_satuan' => 'Id Satuan',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'nama_satuan' => 'Nama Satuan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SatuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SatuanQuery(get_called_class());
    }
}
