<?php

namespace backend\controllers;

use Yii;
use common\models\Projeto;
use common\models\TermoAditivo;
use common\models\RelatorioPrestacao;
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
        $dataProviderRelatorioPrestacao = new ActiveDataProvider([
            'query' => RelatorioPrestacao::find()->where([ 'id_projeto' => $id ]),
        ]);

        $dataProviderTermoAditivo = new ActiveDataProvider([
            'query' => TermoAditivo::find()->where([ 'id_projeto' => $id ]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderRelatorioPrestacao' => $dataProviderRelatorioPrestacao,
            'dataProviderTermoAditivo' => $dataProviderTermoAditivo,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->editalFile = UploadedFile::getInstance($model, 'editalFile');
            if($model->editalFile){
              if ($model->upload('edital')) {
                // file is uploaded successfully
              }else{
                //error message
              }
            }

            $model->tituloProjetoFile = UploadedFile::getInstance($model, 'tituloProjetoFile');
            if($model->tituloProjetoFile){
              if ($model->upload('titulo_projeto')) {
                // file is uploaded successfully
              }else{
                //error message
              }
            }

            $this->mensagens('success', 'Projeto criado', 'Projeto criado com sucesso.');

            return $this->redirect(['item/index', 'id_projeto' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,

        ]);
    }

    public function actionDeleteedital($id)
    {
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/edital/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          unlink($file);
          $this->mensagens('success', 'Anexo', 'Edital excluido com sucesso.');
        }else{
          $this->mensagens('error', 'Anexo', 'Nenhum edital para excluir.');
        }
      }else $this->mensagens('error', 'Anexo', 'Nenhum edital para excluir.');
      return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionDeletetitulo($id)
    {
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          unlink($file);
          $this->mensagens('success', 'Anexo', 'Edital excluido com sucesso.');
        }else{
          $this->mensagens('error', 'Anexo', 'Nenhum arquivo de projeto para excluir.');
        }
      }else $this->mensagens('error', 'Anexo', 'Nenhum arquivo de projeto para excluir.');
      return $this->redirect(['view', 'id' => $model->id]);
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

              $path = \Yii::getAlias('@backend/../uploads/projetos/edital/');

              $files = \yii\helpers\FileHelper::findFiles($path, [
                'only' => [$model->id . '.*'],
              ]);
              if (isset($files[0])) {
                $file = $files[0];

                if (file_exists($file)) {
                  unlink($file);
                }
              }

              if ($model->upload('edital')) {
                // file is uploaded successfully
              }else{
                $this->mensagens('error', 'Upload', 'erro no upload do arquivo');
              }
            }

            $model->tituloProjetoFile = UploadedFile::getInstance($model, 'tituloProjetoFile');

            if($model->tituloProjetoFile){

              $path = \Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/');

              $files = \yii\helpers\FileHelper::findFiles($path, [
                'only' => [$model->id . '.*'],
              ]);
              if (isset($files[0])) {
                $file = $files[0];

                if (file_exists($file)) {
                  unlink($file);
                }
              }

              if ($model->upload('titulo_projeto')) {
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

    public function actionDownloadedital($id){
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/edital/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
        }else {
          $this->mensagens('error', 'Edital', 'Arquivo não encontrado.');
        }
      }else {
        $this->mensagens('error', 'Edital', 'Arquivo não encontrado.');
      }

      $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionDownloadtitulo($id){
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
        }else {
          $this->mensagens('error', 'Edital', 'Arquivo não encontrado.');
        }
      }else {
        $this->mensagens('error', 'Edital', 'Arquivo não encontrado.');
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
    public function actionDelete($id){
      $projeto = $this->findModel($id);
      $temTermoAditivo = TermoAditivo::find()->where(['id_projeto' => $projeto->id])->one();
      if(isset($temTermoAditivo)){
        $this->mensagens('danger', 'Erro', 'O projeto não pode ser excluído pois já existem termos aditivos atrelados ao mesmo');
        return $this->redirect(['index']);
      }
      else{
        $this->findModel($id)->delete();
        $this->mensagens('success', 'Projeto excluído', 'Projeto excluído com sucesso.');
        return $this->redirect(['index']);
      }

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
