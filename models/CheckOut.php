<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-25 21:14:43 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-28 22:44:55
 */


namespace app\models;

use Yii;
use yii\base\Model;

class CheckOut extends Model
{
    public $no_rm;

    public $biaya_registrasi;
    public $biaya_tindakan;
    public $biaya_obat;
    public $biaya_penunjang;

    public $total_biaya;
    public $sudah_dibayar;
    public $sisa_pembayaran;

    public $status_pembayaran;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_rm'], 'required'],

            [
                [
                    'biaya_registrasi',
                    'biaya_tindakan',
                    'biaya_obat',
                    'biaya_penunjang',
                ], 'safe'
            ],
            [
                [
                    'biaya_registrasi',
                    'biaya_tindakan',
                    'biaya_obat',
                    'biaya_penunjang',
                ], 'default', 'value' => 0,
            ],
            [
                [
                    'total_biaya',
                    'sudah_dibayar',
                    'sisa_pembayaran',
                ], 'safe',
            ],
            [
                [
                    'total_biaya',
                    'sudah_dibayar',
                    'sisa_pembayaran',
                ], 'default', 'value' => 0,
            ],
            ['status_pembayaran', 'required'],
            ['status_pembayaran', 'number',],
            ['status_pembayaran', 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_rm' => 'No. RM',
        ];
    }

    public function getPasien($no_rm)
    {
        return Pasien::find()
            ->where(['no_rekam_medik' => $no_rm])
            ->one();
    }
}
