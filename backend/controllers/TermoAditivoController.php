<?php

namespace backend\controllers;

use Yii;
use common\models\TermoAditivo;
use common\models\Projeto;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TermoAditivoController implements the CRUD actions for TermoAditivo model.
 */
class TermoAditivoController extends Controller
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
     * Lists all TermoAditivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TermoAditivo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TermoAditivo model.
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
     * Creates a new TermoAditivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {

        $model = new TermoAditivo();
        $projetos = Projeto::find()->all();
        $array_projetos = ArrayHelper::map($projetos, 'id', 'titulo_projeto');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/projeto/view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
            'array_projetos' => $array_projetos,
        ]);
    }

    /**
     * Updates an existing TermoAditivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $projetos = Projeto::find()->all();
        $array_projetos = ArrayHelper::map($projetos, 'id', 'titulo_projeto');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->mensagens('success', 'Termo aditivo', 'Alterações realizadas com sucesso.');
            return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
        }
        return $this->render('update', [
            'model' => $model,
            'array_projetos' => $array_projetos,
        ]);
    }

    /**
     * Deletes an existing TermoAditivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $termoAditivo = $this->findModel($id);
        $idProjeto = $termoAditivo->id_projeto;
        $termoAditivo->delete();
        return $this->redirect(['/projeto/view', 'id' => $idProjeto]);
    }

    /**
     * Finds the TermoAditivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TermoAditivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TermoAditivo::findOne($id)) !== null) {
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
