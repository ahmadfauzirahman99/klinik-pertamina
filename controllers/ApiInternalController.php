<?php

namespace app\controllers;

use app\models\Barang;
use app\models\ItemTindakan;
use app\models\Layanan;
use app\models\Pasien;
use app\models\Pendaftaran;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ApiInternalController extends \yii\web\Controller
{
    public function actionCariRm($q, $limit = 150)
    {
        $pasien_di_pendaftaran = Layanan::find()
            ->alias('l')
            ->select([
                'pdf.kode_pasien id',
                'l.registrasi_kode no_daftar',
                'p.no_rekam_medik no_rm',
                'p.nama_lengkap nama',
                'l.unit_tujuan_kode id_poli',
                'u.nama_poli nama_poli',
                'l.tgl_masuk tgl_masuk',
            ])
            ->where([
                'or',
                ['like', 'pdf.kode_pasien', $q],
                ['like', 'p.nama_lengkap', $q],
            ])
            ->joinWith([
                'pendaftaran pdf',
                'pendaftaran.pasien p',
                'unit u',
            ], false)
            ->limit($limit)
            ->orderBy([
                'l.tgl_masuk' => SORT_DESC,
                'pdf.tgl_masuk' => SORT_DESC,
            ])
            ->asArray()
            ->all();

        $hasil = [
            'results' => $pasien_di_pendaftaran,
        ];

        return Json::encode($hasil);
    }

    public function actionCariTindakan($q, $limit = 150)
    {
        $tindakan = ItemTindakan::find()
            ->where([
                'like', 'nama_tindakan', $q
            ])
            ->limit($limit)
            ->all();

        $tindakan = ArrayHelper::getColumn($tindakan, function ($data) {
            return [
                'id' => $data->id_tindakan,
                'text' => $data->nama_tindakan,
                'harga_jual' => $data->harga_jual,
            ];
        });

        $hasil = [
            'results' => $tindakan,
        ];

        return Json::encode($hasil);
    }

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
