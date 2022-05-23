<?php

namespace app\controllers;

use app\components\SSP;
use app\components\SSPF;
use Yii;
use app\models\Barang;
use app\models\BarangSearch;
use app\models\Satuan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * BarangController implements the CRUD actions for Barang model.
 */
class BarangController extends Controller
{

    // /**
    //  * {@inheritdoc}
    //  */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Barang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Barang model.
     * @param string $id
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
     * Creates a new Barang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Barang();

        if ($model->load(Yii::$app->request->post())) {

            $model->setKodeBarang();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Berhasil menyimpan Barang. <b>' . $model->id_barang . ' : ' . $model->nama_barang . '</b> &nbsp; <a class="btn bg-gradient-secondary" href="' . Url::to(['/barang/update', 'id' => $model->id_barang]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan Barang. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }
        $model->stok = 1;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Barang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Berhasil mengubah & menyimpan Barang. <b>' . $model->id_barang . ' : ' . $model->nama_barang . '</b> &nbsp; <a class="btn bg-gradient-secondary" href="' . Url::to(['/barang/update', 'id' => $model->id_barang]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan Barang. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Barang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Barang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Barang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Barang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionIndexObat()
    {
        return $this->render('index-obat');
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionApiIndexObat()
    {
        // $this->enableCsrfValidation = false;

        $tbl = Barang::tableName();
        $joinTable = Satuan::tableName();
        $columns = [
            ['db' => 'mb.id_barang', 'dt' => 0, 'field' => 'id_barang'],
            ['db' => 'mb.nama_barang', 'dt' => 1, 'field' => 'nama_barang'],
            ['db' => 'ms.nama_satuan', 'dt' => 2, 'field' => 'nama_satuan'],
            array("db" => "ms.id_satuan", "dt" => 3, 'field' => 'id_satuan', "formatter" => function ($d, $row) {
                return '<a href="#" onClick="click(2)">Click Saya</a>';
            })
        ];

        $primarykey = 'id_barang';

        $joinQuery = "FROM {$tbl} AS mb LEFT JOIN {$joinTable} as ms ON mb.id_satuan = ms.id_satuan";
        echo json_encode(
            SSPF::simple($_POST, Yii::$app->params['sql_details'], $tbl, $primarykey, $columns, $joinQuery)
        );
        exit();
    }
}
