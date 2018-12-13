<?php

namespace backend\controllers;

use Yii;
use common\models\TermoAditivo;
use common\models\Projeto;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
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
        $model->id_projeto = $id;
        if($model->tipo == '0' || $model->tipo == '1')
          $model->valor = NULL;

        if ($model->load(Yii::$app->request->post())) {
            $model->termoFile = UploadedFile::getInstance($model, 'termoFile');
            if($model->validate() && $model->save()){
              if($model->termoFile){
                if ($model->upload()) {
                  // file is uploaded successfully
                }else{
                  //error message
                }
              }

              $this->mensagens('success', 'Termo aditivo criado', 'Termo aditivo criado com sucesso.');
              return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'array_projetos' => $array_projetos,
        ]);
    }

    public function actionDownload($id){
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
        }else {
          $this->mensagens('error', 'Termo aditivo', 'Arquivo não encontrado.');
        }
      }else {
        $this->mensagens('error', 'Termo aditivo', 'Arquivo não encontrado.');
      }

      $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
    }

    public function actionDeleteanexo($id)
    {
      $this->mensagens('success', 'Anexo', $id);
      $model = $this->findModel($id);

      $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          unlink($file);
          $this->mensagens('success', 'Anexo', 'Termo aditivo excluido com sucesso.');
        }else{
          $this->mensagens('error', 'Anexo', 'Nenhum termo aditivo para excluir.');
        }
      }else $this->mensagens('error', 'Anexo', 'Nenhum termo aditivo para excluir.');
      return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
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
        if($model->tipo == '0' || $model->tipo == '1')
          $model->valor = NULL;

      if ($model->load(Yii::$app->request->post())) {
            $model->termoFile = UploadedFile::getInstance($model, 'termoFile');
            if($model->validate() && $model->save()){
              if($model->termoFile){
                $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

                $files = \yii\helpers\FileHelper::findFiles($path, [
                  'only' => [$model->id . '_' . $model->id_projeto . '.*'],
                ]);
                if (isset($files[0])) {
                  $file = $files[0];

                  if (file_exists($file)) {
                    unlink($file);
                  }
                }
                if ($model->upload()) {
                  // file is uploaded successfully
                }else{
                  //error message
                }
              }
              $this->mensagens('success', 'Termo aditivo', 'Alterações realizadas com sucesso.');
              return $this->redirect(['/projeto/view', 'id' => $model->id_projeto ]);
            }
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
        $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$termoAditivo->id . '_' . $termoAditivo->id_projeto . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if (file_exists($file)) {
            unlink($file);
          }
        }
        $termoAditivo->delete();
        $this->mensagens('success', 'Termo aditivo excluído', 'Termo aditivo excluído com sucesso.');
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
