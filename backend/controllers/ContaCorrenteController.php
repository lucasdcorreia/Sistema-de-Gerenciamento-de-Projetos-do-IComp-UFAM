<?php

namespace backend\controllers;

use Yii;
use common\models\ContaCorrente;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContaCorrenteController implements the CRUD actions for ContaCorrente model.
 */
class ContaCorrenteController extends Controller
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
     * Lists all ContaCorrente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContaCorrente::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContaCorrente model.
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
     * Creates a new ContaCorrente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_projeto, $tipo_conta_corrente)
    {
        $model = new ContaCorrente();
        $model->id_projeto = $id_projeto;
        $model->tipo_conta_corrente = $tipo_conta_corrente;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->contaFile = UploadedFile::getInstance($model, 'contaFile');
            if($model->contaFile){
              if ($model->upload()) {
                // file is uploaded successfully
              }else{
                //error message
              }
            }

            $this->mensagens('success', 'Conta corrente', 'Corrente corrente criada com sucesso.');
            return $this->redirect(['orcamento/index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('create', [
            'model' => $model,
            'tipo_conta_corrente' => $model->tipo_conta_corrente,
        ]);
    }

    public function actionDownload($id){
      $model = $this->findModel($id);

      if($model->tipo_conta_corrente==1)
        $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/');
      else if($model->tipo_conta_corrente==2)
        $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
        }else {
          $this->mensagens('error', '', 'Arquivo não encontrado.');
        }
      }else {
          $this->mensagens('error', 'Conta corrente', 'Arquivo não encontrado.');
      }

      $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
    }

    public function actionDeleteanexo($id)
    {
      $this->mensagens('success', 'Anexo', $id);
      $model = $this->findModel($id);

      if($model->tipo_conta_corrente==1)
        $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/');
      else if($model->tipo_conta_corrente==2)
        $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/');


      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          unlink($file);
          $this->mensagens('success', 'Anexo', 'Conta corrente excluida com sucesso.');
        }else{
          $this->mensagens('error', 'Anexo', 'Nenhuma conta corrente para excluir.');
        }
      }else $this->mensagens('error', 'Anexo', 'Nenhuma conta corrente para excluir.');
      return $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
    }


    /**
     * Updates an existing ContaCorrente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->contaFile = UploadedFile::getInstance($model, 'contaFile');
            if($model->contaFile){
              if($model->tipo_conta_corrente==1)
                $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/');
              else if($model->tipo_conta_corrente==2)
                $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/');

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
            $this->mensagens('success', 'Conta corrente', 'Alterações realizadas com sucesso.');
            return $this->redirect(['orcamento/index', 'id_projeto' => $model->id_projeto]);
        }

        return $this->render('update', [
            'model' => $model,
            'tipo_conta_corrente' => $model->tipo_conta_corrente,
        ]);
    }

    /**
     * Deletes an existing ContaCorrente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_projeto = $model->id_projeto;
        if($model->tipo_conta_corrente==1)
          $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/');
        else if($model->tipo_conta_corrente==2)
          $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '_' . $model->id_projeto . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if (file_exists($file)) {
            unlink($file);
          }
        }
        $model->delete();
        return $this->redirect(['orcamento/index', 'id_projeto' => $id_projeto]);
    }

    /**
     * Finds the ContaCorrente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContaCorrente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContaCorrente::findOne($id)) !== null) {
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
