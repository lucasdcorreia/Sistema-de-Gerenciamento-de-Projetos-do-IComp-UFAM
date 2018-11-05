<?php

namespace backend\controllers;

use Yii;
use common\models\Projeto;
use common\models\TermoAditivo;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProjetoController implements the CRUD actions for Projeto model.
 */
class ProjetoController extends Controller
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
     * Lists all Projeto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Projeto::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projeto model.
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
     * Creates a new Projeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projeto();
        $modelTermoAditivo = new TermoAditivo();
        $projetos = Projeto::find()->all();
        $array_projetos = ArrayHelper::map($projetos, 'id', 'titulo_projeto');
        if ($model->load(Yii::$app->request->post()) && $modelTermoAditivo->load(Yii::$app->request->post()) && $model->save() && $modelTermoAditivo->save()) {
            $model->editalFile = UploadedFile::getInstance($model, 'editalFile');
            if($model->editalFile){
              if ($model->upload()) {
                // file is uploaded successfully
              }else{
                //error message
              }
            }

            $this->mensagens('success', 'Projeto criado', 'Projeto criado com sucesso.');

/*
            // insercao de termo aditivo
            $connection = Yii::$app->getDb();
            $sql = "INSERT INTO termo_aditivo

                VALUES (NULL, 000000000, 'GAMBIARRA 2', NULL, ".$model->id.");";
            $connection->createCommand($sql)->execute();
*/
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelTermoAditivo' => $modelTermoAditivo,
            'array_projetos' => $array_projetos,
        ]);
    }

    /**
     * Updates an existing Projeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->editalFile = UploadedFile::getInstance($model, 'editalFile');
            if($model->editalFile){
              if ($model->upload()) {
                // file is uploaded successfully
              }else{
                $this->mensagens('error', 'Upload', 'erro no upload do arquivo');
              }
            }
            $this->mensagens('success', 'Projeto alterado', 'Projeto alterado com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDownload($id){
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . $model->edital . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
          $this->mensagens('success', 'Download', $path . $file);
        }else {
          $this->mensagens('error', 'Edital', 'Arquivo não encontrado.');
        }
      }

      $this->redirect(['view', 'id' => $model->id]);
    }




    /**
     * Deletes an existing Projeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->mensagens('success', 'Projeto excluído', 'Projeto excluído com sucesso.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projeto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projeto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /* Envio de mensagens para views
       Tipo: success, danger, warning*/
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
