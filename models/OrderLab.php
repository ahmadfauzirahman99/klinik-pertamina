<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_lab".
 *
 * @property int $id_lab
 * @property string $no_transaksi
 * @property int $poli_id
 * @property string $diagnosa
 * @property string $kondisi_sampel
 * @property string $catatan
 * @property string $no_rekam_medik
 * @property string $no_daftar
 * @property string|null $created_by
 * @property string $created_at
 * @property string|null $updated_by
 * @property string $updated_at
 */
class OrderLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_transaksi', 'poli_id', 'diagnosa', 'kondisi_sampel', 'catatan', 'no_rekam_medik', 'no_daftar'], 'required'],
            [['poli_id'], 'integer'],
            [['diagnosa', 'catatan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['no_transaksi', 'kondisi_sampel', 'no_rekam_medik', 'no_daftar', 'created_by', 'updated_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lab' => 'Id Lab',
            'no_transaksi' => 'No Trans',
            'poli_id' => 'Dari Poli',
            'diagnosa' => 'Diagnosa',
            'kondisi_sampel' => 'Kondisi Sampel',
            'catatan' => 'Catatan',
            'no_rekam_medik' => 'No RM',
            'no_daftar' => 'No Daftar',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
