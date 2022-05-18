<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-09-19 10:48:58 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-10-05 09:21:14
 */


namespace app\controllers;

use app\components\Model;
use app\models\OrderLab;
use app\models\OrderLabDetail;
use app\models\CheckOut;
use app\models\ItemTindakan;
use app\models\Layanan;
use app\models\LayananDetail;
use app\models\Pasien;
use app\models\Pembayaran;
use app\models\Pendaftaran;
use Yii;
use app\models\Resep;
use app\models\ResepDetail;
use Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class PosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTindakan($reg = null, $rm = null)
    {
        $model = new Layanan();
        $modelDetail = [new LayananDetail()];

        if ($reg != null & $rm != null) {
            $model = Layanan::find()
                ->where(
                    ['registrasi_kode' => $reg,],
                )
                ->one();
            $pasien = Pasien::find()->where(['no_rekam_medik' => $rm])->one();
            $model->nama_pasien = $pasien->nama_lengkap;
            $model->no_rm = $pasien->no_rekam_medik;

            $model->tgl_masuk = Yii::$app->formatter->asDate($model->tgl_masuk);
            $model->tgl_keluar = Yii::$app->formatter->asDate($model->tgl_keluar);

            $modelDetail = $model->layananDetail ?? [new LayananDetail()];
        }


        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelDetail, 'id_layanan_detail', 'id_layanan_detail');
            $modelDetail = Model::createMultiple(LayananDetail::classname(), $modelDetail, 'id_layanan_detail');
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDetail, 'id_layanan_detail', 'id_layanan_detail')));


            $model->tgl_masuk = Yii::$app->formatter->asDate($model->tgl_masuk, 'php:Y-m-d H:i:s');

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {


                    // $model->setNoLayananNoPenjualan();

                    if ($flag = $model->save(false)) {
                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        if (!empty($deletedIDs)) {
                            LayananDetail::deleteAll(['id_layanan_detail' => $deletedIDs]);
                        }

                        // untuk save detail ke tabel pengadaan_detail
                        foreach ($modelDetail as $modelDetail) {


                            $modelDetail->id_layanan = $model->id_layanan;

                            if (!($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                Yii::error($modelDetail->errors);
                                echo "<pre>";
                                print_r($modelDetail->errors);
                                echo "</pre>";
                                die;
                                break;
                            } else {
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

                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        return $this->redirect([
                            '/pos/tindakan',
                            'reg' => $model->registrasi_kode,
                            'rm' => $model->no_rm,
                        ]);
                        // return $this->redirect(Yii::$app->request->referrer);

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


        return $this->render('tindakan', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new LayananDetail()] : $modelDetail,
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
                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        return $this->redirect([
                            '/pos/obat',
                            'reg' => $model->no_daftar,
                            'rm' => $model->no_rm,
                        ]);
                        // return $this->redirect(Yii::$app->request->referrer);

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

        return $this->render('obat', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,

        ]);
    }
    public function actionPenunjang($reg = null, $rm = null)
    {
        // $model = OrderLab::find()->all();
        $model = new OrderLab();
        $modelDetail = [new OrderLabDetail()];

        if ($reg != null & $rm != null) {
            $model = OrderLab::find()
                ->where([
                    'and',
                    ['no_daftar' => $reg,],
                    ['no_rekam_medik' => $rm,],
                ])
                ->one();
            if (!$model) { // kalau OrderLabnya belum nemu
                $model = new OrderLab();
                $pasien = Pasien::find()->where(['no_rekam_medik' => $rm])->one();
                $model->nama_pasien = $pasien->nama_lengkap;
                $model->no_rekam_medik = $pasien->no_rekam_medik;
                $model->tanggal = date('d-m-Y');
                $model->total_harga = 0;
            } else {
                $model->tanggal = Yii::$app->formatter->asDate($model->tanggal);
            }
            $model->no_daftar = $reg;
            $model->no_transaksi = 'T';
            $modelDetail = $model->labDetail ?? [new OrderLabDetail()];
        }
        if ($model->load(Yii::$app->request->post())) {

            // echo '<pre>';
            // var_dump($_POST);
            // die();
            // echo '</pre>';
            $oldIDs = ArrayHelper::map($modelDetail, 'id_order_lab_detail', 'id_order_lab_detail');
            $modelDetail = Model::createMultiple(OrderLabDetail::classname(), $modelDetail, 'id_order_lab_detail');
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDetail, 'id_order_lab_detail', 'id_order_lab_detail')));


            $model->tanggal = Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d');

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelDetail) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {


                    if ($flag = $model->save(false)) {

                        if (!empty($deletedIDs)) {
                            OrderLabDetail::deleteAll(['id_order_lab_detail' => $deletedIDs]);
                        }

                        // untuk save detail ke tabel pengadaan_detail
                        foreach ($modelDetail as $modelDetail) {
                            // var_dump($modelDetail);
                            // exit;
                            // $modelDetail->harga_tindakan = $_POST['OrderLabDetail']['harga_tindakan'];
                            $modelDetail->id_order_lab = $model->id_lab;
                            if (!($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                Yii::error($modelDetail->errors);
                                // echo "<pre>";
                                // print_r($modelDetail->errors);
                                // echo "</pre>";
                                // die;
                                break;
                            } else {
                            }
                        }
                    } else {
                        $transaction->rollBack();
                        Yii::error($model->errors);
                        // echo "<pre>";
                        // print_r($model->errors);
                        // echo "</pre>";
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

                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        return $this->redirect([
                            '/pos/penunjang',
                            'reg' => $model->no_daftar,
                            'rm' => $model->no_rekam_medik,
                        ]);

                        // return $this->redirect(Yii::$app->request->referrer);

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
        return $this->render('penunjang', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new OrderLabDetail()] : $modelDetail,

        ]);
    }

    public function actionCetakPenunjang($reg = null, $rm = null)
    {
        $model = (new \yii\db\Query())
            ->select([
                'ol.no_transaksi',
                'ol.diagnosa',
                'ol.no_rekam_medik',
                'ol.no_daftar',
                'ol.id_lab',
                'ol.no_transaksi',
                'ol.nama_pasien',
                'p.nama_lengkap',
                'p.alamat_lengkap',
                'p.kel',
                'p.kec',
                'p.kab',
                'p.nama_ayah',
                'p.nama_ibu',
                'p.tempat_lahir',
                'p.tanggal_lahir'
            ])
            ->from('order_lab ol')
            ->leftjoin('pasien p', 'p.no_rekam_medik=ol.no_rekam_medik')
            ->where([
                'and',
                ['ol.no_daftar' => $reg,],
                ['ol.no_rekam_medik' => $rm,],
            ])->one();

        $modelDetail = (new \yii\db\Query())
            ->select([
                'old.item_pemeriksaan',
                'old.jumlah',
                'old.harga_tindakan harga_tindakan',
                'old.subtotal subtotal',
                'old.catatan catatan',
                'il.nama_item nama_item',
                'il.nama_jenis nama_jenis'
            ])
            ->from('order_lab_detail old')
            ->leftjoin('item_lab il', 'il.id_item_lab=old.item_pemeriksaan')
            ->where(['id_order_lab' => $model['id_lab']])->all();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'legal',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        $mpdf->SetWatermarkImage(Url::to('@web/img/syafira.png'));
        $mpdf->showWatermarkImage = true;

        $mpdf->SetTitle('Laporan');
        $mpdf->WriteHTML($this->renderPartial('cetak_penunjang', [
            'model' => $model,
            'modelDetail' => $modelDetail,
            // 'no_rm' => $no_rm,
            // 'pasien' => DataLayanan::find()->where(['no_rekam_medik' => $no_rm])->one(),
        ]));
        // $mpdf->Output('Spesialis Gigi ' . $model['no_rekam_medik'] . '.pdf', 'I');
        $mpdf->Output('Laporan.pdf', 'I');
        exit;
        // return $this->render('anastesi');
    }


    public function actionCheckOut($reg = null, $rm = null)
    {
        $model = new CheckOut();
        $pendaftaran = new Pendaftaran();
        $pasien = new Pasien();
        $tindakan = new Layanan();
        $resep = new Resep();
        $penunjang = new OrderLab();

        if ($reg != null & $rm != null) {
            $pendaftaran = Pendaftaran::find()
                ->where([
                    'and',
                    ['id_pendaftaran' => $reg,],
                    ['kode_pasien' => $rm,],
                ])
                ->one();

            if ($pendaftaran) {
                $pendaftaran->tgl_masuk = Yii::$app->formatter->asDate($pendaftaran->tgl_masuk);
                $model->no_rm = $pendaftaran->kode_pasien;

                $pasien = $pendaftaran->pasien;
                $pasien->tanggal_lahir = Yii::$app->formatter->asDate($pasien->tanggal_lahir);

                $tindakan = $pendaftaran->layanan;
                $tindakan->total_bayar = $tindakan->getLayananDetail()->sum('subtotal');

                $resep = $pendaftaran->resep;
                $penunjang = $pendaftaran->penunjang;

                $model->biaya_registrasi = $tindakan->biaya_registrasi ?? 0;
                $model->biaya_tindakan = $tindakan->total_bayar ?? 0;
                $model->biaya_obat = $resep->total_bayar ?? 0;
                $model->biaya_penunjang = $penunjang->total_harga ?? 0;

                $model->total_biaya = $model->biaya_registrasi + $model->biaya_tindakan + $model->biaya_obat + $model->biaya_penunjang;
                $model->sudah_dibayar = 0;
                $model->sisa_pembayaran = $model->total_biaya - $model->sudah_dibayar;

                // cek pembayaran (udah dibayar atau belum)
                $pembayaran = $pendaftaran->pembayaran;
                if ($pembayaran) {
                    $model->sudah_dibayar = $pembayaran->total_bayar;
                    $model->sisa_pembayaran = $model->total_biaya - $model->sudah_dibayar;
                }
                if ($model->sisa_pembayaran == 0)
                    $model->status_pembayaran = 1;

                // echo "<pre>";
                // print_r($pembayaran);
                // // print_r($tindakan->getLayananDetail()->count());
                // echo "</pre>";
                // die;
            }
        }

        // echo "<pre>";
        // var_dump($resep->getResepDetail()->exists());
        // var_dump($penunjang->getLabDetail()->exists());
        // echo "</pre>";
        // die;

        return $this->render('check-out', [
            'model' => $model,
            'pendaftaran' => $pendaftaran,
            'pasien' => $pasien,
            'tindakan' => $tindakan,
            'resep' => $resep,
            'penunjang' => $penunjang,
            // 'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,
        ]);
    }

    public function actionBayar()
    {
        $pembayaran = new Pembayaran();
        $pembayaran->attributes = ($data = Yii::$app->request->post());
        $pembayaran->tanggal = date('Y-m-d');
        $pembayaran->jam = date('H:i:s');

        $pendaftaran = Pendaftaran::find()
            ->where([
                'and',
                ['id_pendaftaran' => $data['no_daftar'],],
                ['kode_pasien' => $data['no_rm'],],
            ])
            ->one();

        if ($pendaftaran->layanan) {
            $tindakan = $pendaftaran->layanan->toArray();
            $tindakan['tindakan_detail'] = $pendaftaran->layanan->getLayananDetail()->asArray()->all();
            $detail['tindakan'] = $tindakan;
        }

        if ($pendaftaran->resep) {
            $resep = $pendaftaran->resep->toArray();
            $resep['resep_detail'] = $pendaftaran->resep->getResepDetail()->asArray()->all();
            $detail['resep'] = $resep;
        }

        if ($pendaftaran->penunjang) {
            $penunjang = $pendaftaran->penunjang->toArray();
            $penunjang['penunjang_detail'] = $pendaftaran->penunjang->getLabDetail()->asArray()->all();
            $detail['penunjang'] = $penunjang;
        }


        $pembayaran->json_detail = json_encode($detail);
        if ($pembayaran->save()) {
            return json_encode([
                's' => true,
                'm' => 'Berhasil',
            ]);
        } else {
            return json_encode([
                's' => false,
                'm' => $pembayaran->errors,
            ]);
        }
    }

    public function actionInvoice($reg, $rm)
    {
        $model = new CheckOut();
        $pendaftaran = Pendaftaran::find()
            ->where([
                'and',
                ['id_pendaftaran' => $reg,],
                ['kode_pasien' => $rm,],
            ])
            ->one();
        $pendaftaran->tgl_masuk = Yii::$app->formatter->asDate($pendaftaran->tgl_masuk);
        $model->no_rm = $pendaftaran->kode_pasien;

        $pasien = $pendaftaran->pasien;
        $pasien->tanggal_lahir = Yii::$app->formatter->asDate($pasien->tanggal_lahir);

        $tindakan = $pendaftaran->layanan;
        $tindakan->total_bayar = $tindakan->getLayananDetail()->sum('subtotal');

        $resep = $pendaftaran->resep;
        $penunjang = $pendaftaran->penunjang;

        $model->biaya_registrasi = $tindakan->biaya_registrasi ?? 0;
        $model->biaya_tindakan = $tindakan->total_bayar ?? 0;
        $model->biaya_obat = $resep->total_bayar ?? 0;
        $model->biaya_penunjang = $penunjang->total_harga ?? 0;

        $model->total_biaya = $model->biaya_registrasi + $model->biaya_tindakan + $model->biaya_obat + $model->biaya_penunjang;
        $model->sudah_dibayar = 0;
        $model->sisa_pembayaran = $model->total_biaya - $model->sudah_dibayar;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'legal',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 5,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        // $mpdf->SetWatermarkImage(Url::to('@web/img/syafira.png'), -1, [170, 100]);
        $mpdf->showWatermarkImage = true;

        $mpdf->SetTitle('Laporan');
        $mpdf->WriteHTML($this->renderPartial('invoice', [
            'model' => $model,
            'pendaftaran' => $pendaftaran,
            'pasien' => $pasien,
            'tindakan' => $tindakan,
            'resep' => $resep,
            'penunjang' => $penunjang,
        ]));
        $mpdf->Output('Laporan.pdf', 'I');
        exit;
    }
}
