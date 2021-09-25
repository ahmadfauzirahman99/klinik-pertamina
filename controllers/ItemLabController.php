<?php

namespace app\controllers;

use Yii;
use app\models\ItemLab;
use app\models\ItemLabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ItemLabController implements the CRUD actions for ItemLab model.
 */
class ItemLabController extends Controller
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
     * Lists all ItemLab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemLabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemLab model.
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
     * Creates a new ItemLab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemLab();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_item_lab]);
        // }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil menyimpan data Tindakan Penunjang. <b>' . $model->id_item_lab . ' : '. $model->nama_item . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/item-lab/update', 'id' => $model->id_item_lab]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data Tindakan Penunjang. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItemLab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_item_lab]);
        // }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '<span style="color:#fff">Berhasil mengubah data Tindakan Penunjang. <b>' . $model->id_item_lab . ' : '. $model->nama_item . '</b> </span>&nbsp; <a style="color:#fff"class="btn bg-gradient-secondary" href="' . Url::to(['/item-lab/update', 'id' => $model->id_item_lab]) . '">Ubah <i class="fas fa-edit fa-md"></i></a>');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal mengubah data Tindakan Penunjang. <pre>' . json_encode($model->errors) . '</pre>');
            }
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItemLab model.
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
     * Finds the ItemLab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemLab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemLab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
