<?php

namespace backend\controllers;

use Yii;
use common\models\Item;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $model = new Item();

        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
        ]);

        $dataProviderMatConsumo = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 1, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalMatConsumo = Item::find()->
        where(['tipo_item' => 1, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderMatPermanente = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 2, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalMatPermanente = Item::find()->
        where(['tipo_item' => 2, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderServTerceiroPF = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 3, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalServTerceiroPF = Item::find()->
        where(['tipo_item' => 3, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderServTerceiroPJ = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 4, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalServTerceiroPJ = Item::find()->
        where(['tipo_item' => 4, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderPassagemNacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 5, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalPassagemNacional = Item::find()->
        where(['tipo_item' => 5, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderPassagemInternacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 6, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalPassagemInternacional = Item::find()->
        where(['tipo_item' => 6, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderDiariaNacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 7, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalDiariaNacional = Item::find()->
        where(['tipo_item' => 7, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        $dataProviderDiariaInternacional = new ActiveDataProvider([
            'query' => Item::find()->where(['tipo_item' => 8, 'id_projeto' => $id_projeto]),
        ]);

        $subtotalDiariaInternacional = Item::find()->
        where(['tipo_item' => 8, 'id_projeto' => $id_projeto])->
        sum('custo_unitario * quantidade');

        return $this->render('index', [
            'model' => $model,

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

            'subtotalMatConsumo' => $subtotalMatConsumo,
            'subtotalMatPermanente' => $subtotalMatPermanente,
            'subtotalServTerceiroPF' => $subtotalServTerceiroPF,
            'subtotalServTerceiroPJ' => $subtotalServTerceiroPJ,
            'subtotalPassagemNacional' => $subtotalPassagemNacional,
            'subtotalPassagemInternacional' => $subtotalPassagemInternacional,
            'subtotalDiariaNacional' => $subtotalDiariaNacional,
            'subtotalDiariaInternacional' => $subtotalDiariaInternacional,
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
        $professores = User::find()->where(['professor' => 1, 'administrador' => 0])->orderBy('nome ASC')->all();
        $professores_nomes = ArrayHelper::map($professores, 'nome', 'nome');

        if ($model->tipo_item == 2){
            $model->natureza = 'Capital';
        }
        else{
            $model->natureza = 'Custeio';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->mensagens('success', 'Item criado', 'Item criado com sucesso.');
            return $this->redirect(['index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('create', [
            'tipo_item' => $tipo_item,
            'id_projeto' => $id_projeto,
            'model' => $model,
            'professores_nomes' => $professores_nomes,
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

        $professores = User::find()->where(['professor' => 1, 'administrador' => 0])->orderBy('nome ASC')->all();
        $professores_nomes = ArrayHelper::map($professores, 'nome', 'nome');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->mensagens('success', 'Item', 'Alterações realizadas com sucesso.');
            return $this->redirect(['index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('update', [
            'model' => $model,
            'professores_nomes' => $professores_nomes,
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

        $this->mensagens('success', 'Item excluído', 'Item excluído com sucesso.');
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

    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }
}
