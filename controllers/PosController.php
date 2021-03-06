<?php

namespace app\controllers;

use app\components\Helper;
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
use app\models\Racikan;
use app\models\RacikanDetail;
use Yii;
use app\models\Resep;
use app\models\ResepDetail;
use app\models\ResumeRawatJalan;
use app\models\Tuslah;
use Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class PosController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }
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

        $modelRacikan = [new Racikan()];
        // $modelRacikanDetail = [[new RacikanDetail()]];


        if ($reg != null & $rm != null) {
            $pasien = Pasien::find()->where(['no_rekam_medik' => $rm])->one();

            $model = Resep::find()
                ->where([
                    'and',
                    ['no_daftar' => $reg,],
                    ['no_rm' => $rm,],
                ])
                ->one();
            $modelRacikan = Racikan::find()
                ->where([
                    'and',
                    [
                        'no_daftar' => $reg,
                        'no_rekam_medik' => $rm
                    ]
                ])
                ->all();
            // ->one();



            if (!$model) { // kalau resepnya belum nemu
                $model = new Resep();
                $model->nama_pasien = $pasien->nama_lengkap;
                $model->no_rm = $pasien->no_rekam_medik;
                $model->no_daftar = $reg;
                $model->tanggal = date('d-m-Y');
                $model->total_harga = 0;
                $model->diskon_persen = 0;
                $model->diskon_total = 0;
                $model->total_bayar = 0;
            } else {
                $model->tanggal = Yii::$app->formatter->asDate($model->tanggal);
            }

            $modelDetail = $model->resepDetail ?? [new ResepDetail()];
            $modelRacikanDetail =  [[new RacikanDetail()]]; //?????



            if (!$modelRacikan) { // racikan belum nemu
                $modelRacikan = new Racikan();
                $modelRacikan->no_rekam_medik = $pasien->no_rekam_medik;
                $modelRacikan->created_by = 1;
                $modelRacikan->update_by = 1;
                $modelRacikan->total_bayar = 0;
                $modelRacikan->total_harga = 0;
                $modelRacikan->diskon_persen = 0;
                $modelRacikan->diskon_total = 0;
                // $modelRacikan->created_at = date('Y-m-d H:i')
            }
            $modelRacikanDetail = $model->racikanDetail ?? [[new RacikanDetail()]]; //?????
            $modelRacikan = [new Racikan()];
        }




        if ($model->load(Yii::$app->request->post())) {

            // echo '<pre>';
            // print_r($_POST);
            // exit;



            //yang biasa


            $oldIDs = ArrayHelper::map($modelDetail, 'id_resep_detail', 'id_resep_detail');
            $modelDetail = Model::createMultiple(ResepDetail::classname(), $modelDetail, 'id_resep_detail');
            Model::loadMultiple($modelDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDetail, 'id_resep_detail', 'id_resep_detail')));
            $model->tanggal = Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d');

            if (isset($_POST['Racikan'][0][0])) {

                foreach ($_POST['Racikan'] as $indexRacikan => $rooms) {
                    foreach ($rooms as $indexRacikanDetail => $room) {
                        $data['Racikan'] = $room;
                        $modelRacikanDetail = new RacikanDetail();
                        $modelRacikanDetail->load($data);
                        $modelsRoom[$indexRacikan][$indexRacikanDetail] = $modelRacikanDetail;
                        $valid = $modelRacikanDetail->validate();
                    }
                }
            }


            $valid = true;
            if ($valid) {
                // $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        // echo "<pre>";
                        // print_r($model);
                        // echo "</pre>";
                        // die;

                        if (!empty($deletedIDs)) {
                            ResepDetail::deleteAll(['id_resep_detail' => $deletedIDs]);
                        }
                        if ($flag = $model->save(false)) {
                            $text_nya = json_encode(Yii::$app->request->post());
                            Helper::sendTrackTelegram("actionObat \n " . Helper::jsonPretty($text_nya) . "");
                            // echo "<pre>";
                            // print_r($model);
                            // echo "</pre>";
                            // die;

                            if (!empty($deletedIDs)) {
                                ResepDetail::deleteAll(['id_resep_detail' => $deletedIDs]);
                            }

                            // untuk save detail ke tabel pengadaan_detail
                            $array_berhasil_simpan_key = 0;
                            $array_berhasil_simpan['csrf_nya'] = '';
                            foreach ($modelDetail as $modelDetail) {
                                $modelDetail->id_resep = $model->id_resep;
                                if (!($flag = $modelDetail->save(false))) {
                                    $array_berhasil_simpan['modelDetail'][$array_berhasil_simpan_key]['saved'] = 0;
                                    // $transaction->rollBack();
                                    Yii::error($modelDetail->errors);
                                    echo "<pre>";
                                    print_r($modelDetail->errors);
                                    echo "</pre>";
                                    die;
                                    break;
                                } else {
                                    $array_berhasil_simpan['modelDetail'][$array_berhasil_simpan_key]['saved'] = 1;
                                }
                                $array_berhasil_simpan_key++;
                            }

                            $array_berhasil_simpan['csrf_nya'] = Yii::$app->request->post()['_csrf'];

                            $text_nya = json_encode($array_berhasil_simpan);
                            Helper::sendTrackTelegram("actionObat \n " . Helper::jsonPretty($text_nya) . "");
                        } else {
                            // $transaction->rollBack();
                            Yii::error($model->errors);
                            echo "<pre>";
                            print_r($model->errors);
                            echo "</pre>";
                            die;
                        }

                        if ($flag) {
                            // $transaction->commit();

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
                    }
                } catch (Exception $e) {
                    // $transaction->rollBack();

                    echo "<pre>";
                    print_r($e);
                    echo "</pre>";
                    die;
                }
            }
        }

        // echo "<pre>";
        // print_r($modelRacikan);
        // exit;

        // echo "<pre>";
        // print_r($modelRacikanDetail);
        // exit;

        return $this->render('obat', [
            'model' => $model,
            'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,
            'modelRacikanDetail' => (empty($modelRacikanDetail)) ? [[new RacikanDetail()]] : $modelRacikanDetail,
            'modelRacikan' => (empty($modelRacikan)) ? [[new Racikan()]] : $modelRacikan

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

            // $pendaftaran->statu

            if ($pendaftaran) {
                $pendaftaran->tgl_masuk = Yii::$app->formatter->asDate($pendaftaran->tgl_masuk);
                $model->no_rm = $pendaftaran->kode_pasien;




                $pasien = $pendaftaran->pasien;
                $pasien->tanggal_lahir = Yii::$app->formatter->asDate($pasien->tanggal_lahir);

                $tindakan = $pendaftaran->layanan;
                $tindakan->total_bayar = $tindakan->getLayananDetail()->sum('subtotal');

                $resep = $pendaftaran->resep;
                $racikan = $pendaftaran->tuslah;
                $penunjang = $pendaftaran->penunjang;

                $model->biaya_registrasi = $tindakan->biaya_registrasi ?? 0;
                $model->biaya_tindakan = $tindakan->total_bayar ?? 0;
                $model->biaya_obat = $resep->total_bayar ?? 0;
                $model->biaya_penunjang = $penunjang->total_harga ?? 0;


                $model->biaya_obat_racikan = $racikan->total_biaya_racikan ?? 0;

                $model->total_biaya = $model->biaya_registrasi + $model->biaya_tindakan + $model->biaya_obat + $model->biaya_penunjang + $model->biaya_obat_racikan;

                // var_dump($model->total_biaya);
                // exit;
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
            'racikan' => $racikan,
            'penunjang' => $penunjang,
            // 'modelDetail' => (empty($modelDetail)) ? [new ResepDetail()] : $modelDetail,
        ]);
    }

    public function actionBayar()
    {
        $data = Yii::$app->request->post();

        $pembayaran = Pembayaran::find()->where(
            [
                'and',
                [
                    'no_daftar' => $data['no_daftar'],
                    'no_rm' => $data['no_rm']
                ]
            ]
        )->one();


        // var_dump($data);
        // exit;
        if (is_null($pembayaran)) {
            $pembayaran = new Pembayaran();
        }
        // exit;
        // 
        // var_dump($data);
        // exit;
        $pembayaran->attributes = ($data);

        if (!$pembayaran->isNewRecord) {
            $pembayaran->total_bayar = (int)$data['sudah_dibayar'] +  (int)$data['total_bayar'];
        }
        $pembayaran->tanggal = date('Y-m-d');
        $pembayaran->jam = date('H:i:s');

        $pendaftaran = Pendaftaran::find()
            ->where([
                'and',
                ['id_pendaftaran' => $data['no_daftar'],],
                ['kode_pasien' => $data['no_rm'],],
            ])
            ->one();

        $layanan = Layanan::findOne(['registrasi_kode' => $data['no_daftar']]);
        $layanan->status_layanan = 'SELESAI';

        // echo '<pre>';
        // print_r($pendaftaran);
        // // var_dump(Yii::$app->request->post());
        // exit;

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

        $racikan = $pendaftaran->tuslah;
        $model->biaya_obat_racikan = $racikan->total_biaya_racikan ?? 0;

        $model->biaya_registrasi = $tindakan->biaya_registrasi ?? 0;
        $model->biaya_tindakan = $tindakan->total_bayar ?? 0;
        $model->biaya_obat = $resep->total_bayar ?? 0;
        $model->biaya_penunjang = $penunjang->total_harga ?? 0;

        $model->total_biaya = $model->biaya_registrasi + $model->biaya_tindakan + $model->biaya_obat + $model->biaya_penunjang + $model->biaya_obat_racikan;
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

        $mpdf->SetTitle('Invoice Pertamina RUU II PAKNING - ' . $pendaftaran->id_pendaftaran . ' - ' . $pasien->nama_lengkap);
        $mpdf->WriteHTML($this->renderPartial('invoice', [
            'model' => $model,
            'pendaftaran' => $pendaftaran,
            'pasien' => $pasien,
            'tindakan' => $tindakan,
            'resep' => $resep,
            'racikan' => $racikan,
            // 'listRacikan' => $racikan->racikan,
            'penunjang' => $penunjang,
        ]));
        $mpdf->Output('Invoice Pertamina RUU II PAKNING - ' . $pendaftaran->id_pendaftaran . ' - ' . $pasien->nama_lengkap . '.pdf', 'I');
        exit;
    }


    public function actionObatRacikan($reg = null, $rm = null)
    {

        if (is_null($rm)) {

            return $this->redirect(['pasien/index']);
        }

        $pasien = Pasien::findOne(['no_rekam_medik' => $rm]);

        $modelTuslah = Tuslah::find()->where(['no_daftar' => $reg, 'no_rm' => $rm])->one();
        if (is_null($modelTuslah)) {
            $modelTuslah = new Tuslah();
            $modelTuslah->no_rm = $pasien->no_rekam_medik;
            $modelTuslah->no_daftar = $reg;
            $modelTuslah->tanggal = date('Y-m-d');
            $modelTuslah->jam = date('H:i:s');
            $modelTuslah->nama_pasien = $pasien->nama_lengkap;
        } else {
            $modelTuslah->nama_pasien = $pasien->nama_lengkap;
        }
        $modelRacikan = $modelTuslah->racikan;
        $modelRacikanDetail = [];
        foreach ($modelRacikan as $b => $mrac) {
            $modelSubRacikan = Racikan::find()->where(['id_racikan' => $mrac->id_racikan])->one();
            $modelRacikanDetail[$b] = $modelSubRacikan->racikanDetail;
            // $modelRacikanDetail[$mrac->id_racikan] = '';
        }


        if ($modelTuslah->load(Yii::$app->request->post())) {
            $thePost = Yii::$app->request->post();

            $oldIDRacikan = ArrayHelper::map($modelRacikan, 'id_racikan', 'id_racikan');
            $modelRacikan = [];
            // echo "<pre>";
            // print_r($thePost['Racikan']);
            // exit;

            foreach ($thePost['Racikan'] as $h => $Rac01) {
                $modelRacikan[$h] = new Racikan;
                $modelRacikan[$h]->keterangan = $Rac01['keterangan'];
                $modelRacikan[$h]->total_bayar = @$Rac01['total_bayar'];
            }
            if (!$modelRacikan) {
                $modelRacikan = Model::createMultiple(Racikan::className(), $modelRacikan);
            }


            $valid = $modelTuslah->validate();
            if ($valid) {

                if ($flag = $modelTuslah->save(false)) {

                    $text_nya = json_encode(Yii::$app->request->post());
                    Helper::sendTrackTelegram("actionObatRacikan \n " . Helper::jsonPretty($text_nya) . "");
                    // Helper::sendFileTelegram("actionObatRacikan \n " . Helper::jsonPretty($text_nya) . "");
                    // echo "<pre>";
                    // print_r("abcdefgh");
                    // exit;
                    // if (!empty($deletedRacikanDetailIDs)) {
                    //     RacikanDetail::deleteAll(['id_racikan_detail' => $deletedRacikanDetailIDs]);
                    // }

                    // if (!empty($deletedRacikanIDs)) {
                    Racikan::deleteAll(['tuslah' => $modelTuslah->id_tuslah]);
                    RacikanDetail::deleteAll(['tuslah' => $modelTuslah->id_tuslah]);
                    // $ambilIdRacikan_ = Racikan::find()->where(['tuslah' => $modelTuslah->id_tuslah])->all();
                    // if($ambilIdRacikan_){
                    //     $ambilIdRacikan = ArrayHelper::getColumn($ambilIdRacikan_, 'id_racikan');
                    //     RacikanDetail::deleteAll(['in', 'id_racikan', $ambilIdRacikan]);
                    // }
                    // }

                    $i = 0;

                    $array_berhasil_simpan['csrf_nya'] = '';
                    $array_berhasil_simpan_key = 0;
                    foreach ($modelRacikan as $indexRacikan => $modelRacikan) {


                        if ($flag == false) {
                            break;
                        }

                        $modelRacikan->tuslah = $modelTuslah->id_tuslah;
                        $modelRacikan->no_daftar = $modelTuslah->no_daftar;
                        $modelRacikan->no_rekam_medik = $modelTuslah->no_rm;
                        $modelRacikan->total_harga = 0;
                        // $modelRacikan->total_bayar = 0;
                        $modelRacikan->id_poli = 1;
                        $modelRacikan->id_dokter = 1;


                        if (!($flag == $modelRacikan->save(false))) {
                            $array_berhasil_simpan['modelRacikan'][$array_berhasil_simpan_key]['saved'] = 0;
                            break;
                        } {
                            $array_berhasil_simpan['modelRacikan'][$array_berhasil_simpan_key]['saved'] = 1;
                            // echo "<pre>";
                            // print_r("abcdefgh");
                            // exit;
                            $NewRacikanDetail = [[]];
                            $thePost['RacikanDetail'][$i];
                            // foreach ($thePost['RacikanDetail'] as $i => $TheRacikanDetail) {
                            $TheRacikanDetail = $thePost['RacikanDetail'][$i]; {
                                foreach ($TheRacikanDetail as $kunci => $TheRacikanDetail_child) {
                                    $NewRacikanDetail[$i][$kunci] = $TheRacikanDetail_child;
                                    $NewRacikanDetail[$i][$kunci]['id_racikan'] = @$modelRacikan->id_racikan;
                                    $NewRacikanDetail[$i][$kunci]['tuslah'] = @$modelTuslah->id_tuslah;
                                }


                                if (isset($modelRacikan->id_racikan)) {
                                    $currentRacikanDetail = RacikanDetail::find()->where(['id_racikan' => $modelRacikan->id_racikan])->asArray()->count();
                                    if ($currentRacikanDetail > 0) {
                                        $condition = ['id_racikan' => $modelRacikan->id_racikan];
                                        if (RacikanDetail::deleteAll($condition)) {
                                            //berhasil hapus
                                        } else {
                                            // return "gagal hapus";
                                        }
                                    }
                                }
                            }

                            $judul = ['id_barang_racikan', 'keterangan', 'dosis', 'jumlah', 'harga_jual', 'subtotal', 'id_racikan', 'tuslah'];
                            foreach ($NewRacikanDetail as $k => $NRD) {
                                // echo "<pre>";
                                // print_r($NRD);
                                // exit;
                                if (!isset($NRD[0]['id_barang_racikan'])) {
                                    continue;
                                }
                                $hasiBatch = Helper::batchInsert('racikan_detail', $judul, $NRD);
                                if ($hasiBatch) {
                                    $array_berhasil_simpan['modelRacikan'][$array_berhasil_simpan_key]['racikan_detail_batch'] = 1;
                                } else {
                                    $array_berhasil_simpan['modelRacikan'][$array_berhasil_simpan_key]['racikan_detail_batch'] = 0;
                                }
                            }
                        }
                        $i++;

                        // echo '<pre>';
                        // var_dump($modelRacikan);
                        // // var_dump(isset($modelRacikanDetail[$indexRacikan]) && is_array($modelRacikan[$indexRacikan]));
                        // exit;


                        // if (isset($modelRacikanDetail[$indexRacikan]) && is_array($modelRacikan[$indexRacikan])) {
                        //     echo '1';
                        //     exit;
                        // foreach ($modelRacikanDetail[$indexRacikan] as $indexRacikanDetail => $modelRacikanDetail) {
                        //     $modelRacikanDetail->id_racikan = $modelRacikan->id_racikan;
                        //     if (!$flag == $modelRacikanDetail->save(false)) {
                        //         // break;
                        //         var_dump($modelRacikanDetail->erros);
                        //     }
                        //     exit;
                        // }
                        // }
                        $array_berhasil_simpan_key++;
                    }

                    $array_berhasil_simpan['csrf_nya'] = Yii::$app->request->post()['_csrf'];

                    $text_nya = json_encode($array_berhasil_simpan);
                    Helper::sendTrackTelegram("actionObatRacikan \n " . Helper::jsonPretty($text_nya) . "");
                }

                if ($flag) {
                    Yii::$app->session->setFlash('success', 'Berhasil menyimpan Obat Racikan');
                    return $this->redirect([
                        '/pos/obat-racikan',
                        'reg' => $modelTuslah->no_daftar,
                        'rm' => $modelTuslah->no_rm,
                    ]);
                } else {
                }
            }
        }

        // echo "<pre>";
        // print_r([[new RacikanDetail], [new RacikanDetail]]);
        // exit;
        // echo "<pre>";
        // print_r((empty($modelRacikanDetail)) ? [[new RacikanDetail]] : $modelRacikanDetail);
        // exit;

        $modelTuslah = $modelTuslah;
        $modelRacikan = (empty($modelRacikan)) ? [new Racikan] : $modelRacikan;
        $modelRacikanDetail = (empty($modelRacikanDetail)) ? [[new RacikanDetail]] : $modelRacikanDetail;

        // echo "<pre>";
        // print_r($modelRacikan);
        // exit;

        //NGEPATCHING cek jika ada kosong
        {
            foreach ($modelRacikan as $o => $racmod) {
                if (!isset($modelRacikanDetail[$o][0])) {
                    Yii::$app->session->setFlash('warning', "Data Kosong pada Racikan Detail (" . $modelRacikan[0]->keterangan . "). Baris ke-" . ($o + 1));
                    $modelRacikanDetail[$o][0] = new RacikanDetail;
                }
            }
        }
        return $this->render('form-obat-racikan', [
            'model' => $modelTuslah,
            'modelRacikan' => $modelRacikan,
            'modelRacikanDetail' => $modelRacikanDetail
        ]);
    }

    public function actionResume($reg = null, $rm = null)
    {

        if (is_null($rm)) {

            return $this->redirect(['pasien/index']);
        }

        $pasien = Pasien::findOne(['no_rekam_medik' => $rm]);
        $model = ResumeRawatJalan::find()
            ->where(['no_rekam_medik' => $rm, 'no_daftar' => $reg])
            ->one();

        if (is_null($model)) {
            $model = new ResumeRawatJalan();
            $model->no_rekam_medik = $rm;
            $model->no_daftar = (int)$reg;
            $model->created_by = Yii::$app->user->identity->u_id;
        }



        if (Yii::$app->request->isPost) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = (string)Yii::$app->user->identity->u_id;
                if ($model->save()) {
                    return [
                        's' => true,
                        'e' => 'Berhasil Membuat Resume Medis'
                    ];
                } else {
                    return [
                        's' => false,
                        'e' => 'Tidak Berhasil Membuat Resume Medis',
                        'error' => $model->errors
                    ];
                }
            }
        }
        return $this->render('resume', [
            'pasien' => $pasien,
            'model' => $model,
            'reg' => $reg
        ]);
    }
}
