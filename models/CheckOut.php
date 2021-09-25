<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-25 21:14:43 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-25 21:25:26
 */


namespace app\models;

use Yii;
use yii\base\Model;

class CheckOut extends Model
{
    public $no_rm;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_rm'], 'required'],

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
