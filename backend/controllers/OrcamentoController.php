<?php

namespace backend\controllers;

use Yii;
use common\models\Orcamento;
use common\models\ValorPago;
use common\models\ContaCorrente;
use common\models\RelatorioPrestacao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrcamentoController implements the CRUD actions for Orcamento model.
 */
class OrcamentoController extends Controller
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
     * Lists all Orcamento models.
     * @return mixed
     */
    public function actionIndex($id_projeto)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orcamento::find()->where([ 'id_projeto' => $id_projeto ]),
        ]);

        $dataProviderValorPago = new ActiveDataProvider([
            'query' => ValorPago::find()->where([ 'id_projeto' => $id_projeto ]),
        ]);

        $dataProviderPrestacaoConta = new ActiveDataProvider([
            'query' => RelatorioPrestacao::find()->where([ 'id_projeto' => $id_projeto, 'tipo_anexo' => 2 ]),
        ]);

        $dataProviderContaCorrenteDesembolso = new ActiveDataProvider([
            'query' => ContaCorrente::find()->where([ 'id_projeto' => $id_projeto, 'tipo_conta_corrente' => 1]),
        ]);

        $dataProviderContaCorrenteRecolhimento = new ActiveDataProvider([
            'query' => ContaCorrente::find()->where([ 'id_projeto' => $id_projeto, 'tipo_conta_corrente' => 2]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderValorPago' => $dataProviderValorPago,
            'dataProviderContaCorrenteDesembolso' => $dataProviderContaCorrenteDesembolso,
            'dataProviderContaCorrenteRecolhimento' => $dataProviderContaCorrenteRecolhimento,
            'dataProviderPrestacaoConta' => $dataProviderPrestacaoConta,
            'id_projeto' => $id_projeto,
        ]);
    }

    /**
     * Displays a single Orcamento model.
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
     * Creates a new Orcamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_projeto)
    {
        $model = new Orcamento();
        $model->id_projeto = $id_projeto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->mensagens('success', 'Orçamento criado', 'Orçamento criado com sucesso.');
            return $this->redirect(['orcamento/index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orcamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->mensagens('success', 'Orçamento', 'Alterações realizadas com sucesso.');
            return $this->redirect(['orcamento/index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orcamento model.
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

        $this->mensagens('success', 'Orçamento excluído', 'Orçamento excluído com sucesso.');
        return $this->redirect(['orcamento/index', 'id_projeto' => $id_projeto]);
    }

    /**
     * Finds the Orcamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orcamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orcamento::findOne($id)) !== null) {
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
