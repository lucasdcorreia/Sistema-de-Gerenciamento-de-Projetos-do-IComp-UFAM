<?php

namespace backend\controllers;

use Yii;
use common\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex($id_projeto)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
        ]);

        $dataProviderMatConsumo = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 1, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderMatPermanente = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 2, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderServTerceiroPF = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 3, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderServTerceiroPJ = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 4, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderPassagemNacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 5, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderPassagemInternacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 6, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderDiariaNacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 7, 'id_projeto' => $id_projeto]),
        ]);

        $dataProviderDiariaInternacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 8, 'id_projeto' => $id_projeto]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,

            'dataProviderMatConsumo' => $dataProviderMatConsumo,

            'dataProviderMatPermanente' => $dataProviderMatPermanente,

            'dataProviderServTerceiroPF' => $dataProviderServTerceiroPF,

            'dataProviderServTerceiroPJ' => $dataProviderServTerceiroPJ,

            'dataProviderPassagemNacional' => $dataProviderPassagemNacional,

            'dataProviderPassagemInternacional' => $dataProviderPassagemInternacional,

            'dataProviderDiariaNacional' => $dataProviderDiariaNacional,

            'dataProviderDiariaInternacional' => $dataProviderDiariaInternacional,

            'id_projeto' => $id_projeto,
        ]);
    }

    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipo_item, $id_projeto)
    {
        $model = new Item();
        $model->tipo_item = $tipo_item;
        $model->id_projeto = $id_projeto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('create', [
            'tipo_item' => $tipo_item,
            'id_projeto' => $id_projeto,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_projeto = $model->id_projeto;
        $model->delete();

        return $this->redirect(['index', 'id_projeto' => $id_projeto]);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
