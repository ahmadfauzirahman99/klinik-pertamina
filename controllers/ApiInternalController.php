<?php

namespace app\controllers;

use app\models\Barang;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ApiInternalController extends \yii\web\Controller
{
    public function actionCariObat($q, $limit = 150)
    {
        $barang = Barang::find()
            ->where([
                'like', 'nama_barang', $q
            ])
            ->with('satuan')
            ->limit($limit)
            ->all();

        $barang = ArrayHelper::getColumn($barang, function ($data) {
            return [
                'id' => $data->id_barang,
                'text' => $data->nama_barang,
                'id_kemasan' => $data->id_kemasan,
                'harga_jual' => $data->harga_jual,
                'stok' => $data->stok,
            ];
        });

        $hasil = [
            'results' => $barang,
        ];

        return Json::encode($hasil);
    }
}
