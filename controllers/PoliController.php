<?php

namespace app\controllers;

use Yii;
use app\models\Poli;
use app\models\PoliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PoliController implements the CRUD actions for Poli model.
 */
class PoliController extends Controller
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
     * Lists all Poli models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poli model.
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
     * Creates a new Poli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poli();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_poli]);
        // }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil menyimpan data Poli. <b>' . $model->id_poli . ' : '. $model->nama_poli . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/poli/update', 'id' => $model->id_poli]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data Poli. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Poli model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_poli]);
        // }
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil mengubah data Poli. <b>' . $model->id_poli . ' : '. $model->nama_poli . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/poli/update', 'id' => $model->id_poli]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal mengubah data Poli. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Poli model.
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
     * Finds the Poli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poli::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
