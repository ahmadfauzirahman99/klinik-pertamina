<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-19 10:48:58 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-19 11:21:55
 */


namespace app\controllers;

use Yii;
use app\models\Resep;
use app\models\ResepDetail;

class PosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionObat()
    {
        $model = new Resep();
        $modelDetail = [new ResepDetail()];


        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id_resep]);
        }

        // utk dev 
        $model->no_daftar = '000001';
        $model->no_rm = '000000';
        $model->nama_pasien = 'Anggia Fatimah';

        $model->tanggal = date('d-m-Y');
        $model->diskon_persen = 0;

        return $this->render('obat', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,

        ]);
    }
}
