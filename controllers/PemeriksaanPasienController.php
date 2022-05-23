<?php

namespace app\controllers;

use app\models\Pasien;

class PemeriksaanPasienController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionPeriksa($reg, $rm)
    {
        $pasien = Pasien::findOne(['no_rekam_medik' => $rm]);
        return $this->render(
            'periksa',
            [
                'pasien' => $pasien,
                'reg' => $reg,
                'rm' => $rm
            ]
        );
    }
}
