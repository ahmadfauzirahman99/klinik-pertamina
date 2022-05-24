<?php

namespace app\controllers;

use app\components\Helper;
use app\models\Layanan;
use app\models\LayananSearch;
use Yii;
use app\models\Pasien;
use app\models\PasienSearch;
use app\models\Pendaftaran;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PasienController implements the CRUD actions for Pasien model.
 */
class PasienController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pasien models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasien model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pasien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pasien();

        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post())) {
                $no_pasien = substr(Helper::createNomorRekamMedik(), -1);
                $no_pasien = (int)$no_pasien + 1;
                $no_pasien = 'K' . str_pad($no_pasien, 6, '0', STR_PAD_LEFT);
                $model->no_rekam_medik = $no_pasien;
                $model->save();
                return [
                    's' => true,
                    'e' => 'Berhasil Menginput Pasien',
                    'id' => $model->id_patient
                ];
                // return $this->redirect(['view', 'id' => $model->id_patient]);
            } else {
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post())) {
                // $no_pasien = substr(Helper::createNomorRekamMedik(), -1);
                // $no_pasien = (int)$no_pasien + 1;
                // $no_pasien = 'K' . str_pad($no_pasien, 6, '0', STR_PAD_LEFT);
                // $model->no_rekam_medik = $no_pasien;
                $model->save();
                return [
                    's' => true,
                    'e' => 'Berhasil Menginput Pasien',
                    'id' => $model->id_patient
                ];
                // return $this->redirect(['view', 'id' => $model->id_patient]);
            } else {
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pasien model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionPendaftaran($id)
    {
        $model = Pasien::findOne($id);
        $pendaftaran = new Pendaftaran();

        $layanan = new Layanan();

        $searchModel = new LayananSearch();
        $dataProvider = $searchModel->searchPasien(Yii::$app->request->queryParams, $model->no_rekam_medik);

        $model_timeline_kunjungan = Layanan::find()->alias('l')
            ->select([
                '*',
                'date(l.tgl_masuk) as tgl_timeline',
            ])
            ->joinWith([
                'pendaftaran p',
                'unit u',
            ])
            ->where([
                'p.kode_pasien' => $model->no_rekam_medik,
            ])
            ->orderBy([
                'id_pendaftaran' => SORT_DESC,
            ])
            ->asArray()
            ->all();

        $model_timeline_kunjungan = ArrayHelper::index($model_timeline_kunjungan, null, 'tgl_timeline');
        if (Yii::$app->request->isAjax) {

            if ($pendaftaran->load(Yii::$app->request->post())) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


                if (empty($_POST['Layanan']['jenis_layanan']) || $_POST['Layanan']['jenis_layanan'] == "") {
                    return [
                        's' => false,
                        'e' => 'Pilih Poli Terlebih Dahulu'
                    ];
                }
                // var_dump($_POST['Pendaftaran']['kode_pasien']);
                // exit;
                if ($_POST['Pendaftaran']['kode_pasien'])

                    $pendaftaran->id_pendaftaran = Helper::GenerateId();
                $pendaftaran->created_by = '1';
                $pendaftaran->created_at = date('Y-m-d H:i:s');
                $pendaftaran->type =  Pendaftaran::WEB;

                // $transaction = \Yii::$app->db->beginTransaction();

                // try {
                if ($pendaftaran->save(false)) {
                    // $pendaftaran->refresh();

                    $layanan->load(Yii::$app->request->post());
                    $layanan->registrasi_kode = $pendaftaran->id_pendaftaran;
                    $layanan->tgl_masuk = $pendaftaran->tgl_masuk;
                    $layanan->tgl_keluar = null;
                    $layanan->id_dokter = 0;
                    $layanan->unit_tujuan_kode = $_POST['Layanan']['jenis_layanan'];
                    $layanan->unit_kode = null;
                    $layanan->keterangan = "-";
                    $layanan->status_layanan = Layanan::DAFTAR;
                    if ($layanan->save(false)) {
                        // $transaction->commit();

                        return [
                            's' => true,
                            'e' => 'Berhasil Mendaftarkan Pasien Ke Poli',
                            'id' => $pendaftaran->kode_pasien
                        ];
                    } else {
                        return [
                            's' => false,
                            'e' => $layanan->errors
                        ];
                    }
                    // disini tempat kirim data pasien ke simrs

                } else {
                    return [
                        's' => false,
                        'e' => $pendaftaran->errors
                    ];
                }
                // } catch (Exception $e) {
                //     // $transaction->rollBack();

                //     echo "<pre>";
                //     print_r($e);
                //     echo "</pre>";
                //     die;
                // }

                // return $this->redirect(['view', 'id' => $model->id_patient]);
            }
        }
        return $this->render(
            'pendaftaran',
            [
                'model' => $model,
                'pendaftaran' => $pendaftaran,
                'layanan' => $layanan,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model_timeline_kunjungan' => $model_timeline_kunjungan,

            ]
        );
    }

    /**
     * Finds the Pasien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCariPasienModal()
    {
        $model = new Pasien();
        return $this->renderAjax('cari-pasien', ['model' => $model]);
    }

    public function actionApiPasien($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = Pasien::find()->select(
                [

                    'id_patient as id',
                    'concat(UPPER(nama_lengkap), " - ", DATE_FORMAT(tanggal_lahir,"%d-%m-%Y")) as text',
                ]
            )
                ->where(['like', 'no_rekam_medik', '%' . $q . '%', false])
                ->orFilterWhere(['like', 'nama_lengkap', '%' . $q . '%', false])
                ->orFilterWhere(['like', 'no_kepesertaan', '%' . $q . '%', false])
                ->asArray()
                ->limit(100)
                ->all();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Pasien::find($id)->no_rekam_medik];
        }
        return $out;
    }
}
