<?php

namespace backend\controllers;

use Yii;
use common\models\Arquivo;
use common\models\Projeto;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArquivoController implements the CRUD actions for Arquivo model.
 */
class ArquivoController extends Controller
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
     * Lists all Arquivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Arquivo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Arquivo model.
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
     * Creates a new Arquivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate($id)
     {

         $model = new Arquivo();
         $projetos = Projeto::find()->all();
         $model->id_projeto = $id;

         if ($model->load(Yii::$app->request->post())) {
             $model->arquivoFile = UploadedFile::getInstance($model, 'arquivoFile');
             if($model->validate() && $model->save()){
               if($model->arquivoFile){
                 if ($model->upload()) {
                   // file is uploaded successfully
                 }else{
                   //error message
                 }
               }

               $this->mensagens('success', 'Arquivo criado', 'Arquivo criado com sucesso.');
               return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
             }
         }

         return $this->render('create', [
             'model' => $model,
         ]);
     }



     public function actionDownload($id){
       $model = $this->findModel($id);

       $path = \Yii::getAlias('@backend/../uploads/projetos/arquivo/');

       $files = \yii\helpers\FileHelper::findFiles($path, [
         'only' => [$model->id . '_' . $model->id_projeto . '.*'],
       ]);
       if (isset($files[0])) {
         $file = $files[0];

         if (file_exists($file)) {
           Yii::$app->response->sendFile($file)->send();
         }else {
           $this->mensagens('error', 'Arquivo', 'Arquivo não encontrado.');
         }
       }else {
         $this->mensagens('error', 'Arquivo', 'Arquivo não encontrado.');
       }

       $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
     }

     public function actionDeleteanexo($id)
     {
       $this->mensagens('success', 'Anexo', $id);
       $model = $this->findModel($id);

       $path = \Yii::getAlias('@backend/../uploads/projetos/arquivo/');

       $files = \yii\helpers\FileHelper::findFiles($path, [
         'only' => [$model->id . '_' . $model->id_projeto . '.*'],
       ]);
       if (isset($files[0])) {
         $file = $files[0];
       if (file_exists($file)) {
           unlink($file);
           $this->mensagens('success', 'Anexo', 'Arquivo excluido com sucesso.');
         }else{
           $this->mensagens('error', 'Anexo', 'Nenhum arquivo para excluir.');
         }
       }else $this->mensagens('error', 'Anexo', 'Nenhum arquivo para excluir.');
       return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
     }




    /**
     * Updates an existing Arquivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
     {
       $model = $this->findModel($id);
       $projetos = Projeto::find()->all();

       if ($model->load(Yii::$app->request->post())) {
             $model->arquivoFile = UploadedFile::getInstance($model, 'arquivoFile');
             if($model->validate() && $model->save()){
               if($model->arquivoFile){
                 $path = \Yii::getAlias('@backend/../uploads/projetos/arquivo/');

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
               $this->mensagens('success', 'Arquivo', 'Alterações realizadas com sucesso.');
               return $this->redirect(['/projeto/view', 'id' => $model->id_projeto ]);
             }
         }
         return $this->render('update', [
             'model' => $model,
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
         $arquivo = $this->findModel($id);
         $idProjeto = $arquivo->id_projeto;
         $path = \Yii::getAlias('@backend/../uploads/projetos/arquivo/');

         $files = \yii\helpers\FileHelper::findFiles($path, [
           'only' => [$arquivo->id . '_' . $arquivo->id_projeto . '.*'],
         ]);
         if (isset($files[0])) {
           $file = $files[0];

           if (file_exists($file)) {
             unlink($file);
           }
         }
         $arquivo->delete();
         $this->mensagens('success', 'Arquivo excluído', 'Arquivo excluído com sucesso.');
         return $this->redirect(['/projeto/view', 'id' => $idProjeto]);
     }

    /**
     * Finds the Arquivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Arquivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Arquivo::findOne($id)) !== null) {
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
