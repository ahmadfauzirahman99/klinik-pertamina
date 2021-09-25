<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-19 10:48:58 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-09-24 17:37:14
 */


namespace app\controllers;

use app\components\Model;
use app\models\Pasien;
use Yii;
use app\models\Resep;
use app\models\ResepDetail;
use Exception;
use yii\helpers\ArrayHelper;

class PosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTindakan($reg = null, $rm = null)
    {

        return $this->render('tindakan', [
            // 'model' => $model,
            // 'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,
        ]);
    }

    public function actionObat($reg = null, $rm = null)
    {
        $model = new Resep();
        $modelDetail = [new ResepDetail()];

        if ($reg != null & $rm != null) {
            $model = Resep::find()
                ->where([
                    'and',
                    ['no_daftar' => $reg,],
                    ['no_rm' => $rm,],
                ])
                ->one();

            if (!$model) { // kalau resepnya belum nemu
                $model = new Resep();
                $pasien = Pasien::find()->where(['no_rekam_medik' => $rm])->one();
                $model->nama_pasien = $pasien->nama_lengkap;
                $model->no_rm = $pasien->no_rekam_medik;
                $model->tanggal = date('d-m-Y');
                $model->total_harga = 0;
                $model->diskon_persen = 0;
                $model->diskon_total = 0;
                $model->total_bayar = 0;
            } else {
                $model->tanggal = Yii::$app->formatter->asDate($model->tanggal);
            }
            $model->no_daftar = $reg;
            $modelDetail = $model->resepDetail ?? [new ResepDetail()];
        }

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelDetail, 'id_resep_detail', 'id_resep_detail');
            $modelDetail = Model::createMultiple(ResepDetail::classname(), $modelDetail, 'id_resep_detail');
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDetail, 'id_resep_detail', 'id_resep_detail')));


            $model->tanggal = Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d');

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {


                    // $model->setNoResepNoPenjualan();

                    if ($flag = $model->save(false)) {
                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        if (!empty($deletedIDs)) {
                            ResepDetail::deleteAll(['id_resep_detail' => $deletedIDs]);
                        }

                        // untuk save detail ke tabel pengadaan_detail
                        foreach ($modelDetail as $modelDetail) {


                            $modelDetail->id_resep = $model->id_resep;
                            // $modelDetail->stok_saat_minta = 0;
                            // $modelDetail->pemakaian_sepekan = 0;
                            // $modelDetail->stok_saat_minta = $modelDetail->barang->getBarangApotek($model->unit_peminta)->sum('jumlah_stok') ?? 0;
                            // $modelDetail->pemakaian_sepekan = $modelDetail->barang->jumlahPakaiPekanIni($model->unit_peminta) ?? 0;

                            if (!($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                Yii::error($modelDetail->errors);
                                echo "<pre>";
                                print_r($modelDetail->errors);
                                echo "</pre>";
                                die;
                                break;
                            } else {

                                // HelperStok::keluar([
                                //     'nama_parent' => Penjualan::tableName(),
                                //     'id_parent' => $model->id_penjualan,
                                //     'nama_child' => PenjualanDetail::tableName(),
                                //     'id_child' => $modelDetail->id_penjualan_detail,
                                //     'id_barang' => $modelDetail->id_barang,
                                //     'id_asal' => $modelDetail->penjualan->id_depo,
                                //     'nama_asal' => $modelDetail->penjualan->depo->nama,
                                //     'id_tujuan' => $modelDetail->penjualan->no_rm,
                                //     'nama_tujuan' => $modelDetail->penjualan->nama_pasien,
                                //     'jumlah_kirim' => $modelDetail->jumlah,
                                // ]);
                            }
                        }
                    } else {
                        $transaction->rollBack();
                        Yii::error($model->errors);
                        echo "<pre>";
                        print_r($model->errors);
                        echo "</pre>";
                        die;
                    }

                    if ($flag) {
                        $transaction->commit();

                        // echo 'suskes yooooooooooo';
                        // die;

                        Yii::$app->session->setFlash('success', 'Berhasil menyimpan');
                        // Yii::$app->session->setFlash('sukses', [
                        //     'status' => 'create',
                        //     'status_flash' => 'Menambah',
                        //     'id' => $model->id_penjualan,
                        //     'no_transaksi' => $model->no_transaksi,
                        //     'no_rm' => $model->no_rm,
                        //     'nama_pasien' => $model->nama_pasien,
                        // ]);
                        return $this->redirect(Yii::$app->request->referrer);

                        // Yii::$app->session->setFlash('success', 'Berhasil menyimpan Distribusi Barang.');
                        // return $this->redirect('index');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();

                    echo "<pre>";
                    print_r($e);
                    echo "</pre>";
                    die;
                }
            }
        }

        // utk dev 
        // $model->no_daftar = '000001';
        // $model->no_rm = '000000';
        // $model->nama_pasien = 'Anggia Fatimah';

        return $this->render('obat', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,

        ]);
    }
}
