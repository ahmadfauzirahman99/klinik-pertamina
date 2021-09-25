<?php

namespace app\controllers;

use Yii;
use app\models\Pekerjaan;
use app\models\PekerjaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PekerjaanController implements the CRUD actions for Pekerjaan model.
 */
class PekerjaanController extends Controller
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
     * Lists all Pekerjaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PekerjaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pekerjaan model.
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
     * Creates a new Pekerjaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pekerjaan();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_pekerjaan]);
        // }
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil menyimpan data Pekerjaan. <b>' . $model->id_pekerjaan . ' : '. $model->nama_pekerjaan . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/pekerjaan/update', 'id' => $model->id_pekerjaan]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data Pekerjaan. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pekerjaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_pekerjaan]);
        // }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil mengubah data Pekerjaan. <b>' . $model->id_pekerjaan . ' : '. $model->nama_pekerjaan . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/pekerjaan/update', 'id' => $model->id_pekerjaan]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal mengubah data Pekerjaan. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pekerjaan model.
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

    /**
     * Finds the Pekerjaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pekerjaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pekerjaan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
