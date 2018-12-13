<?php

namespace backend\controllers;

use Yii;
use common\models\RelatorioPrestacao;
use common\models\Projeto;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelatorioPrestacaoController implements the CRUD actions for RelatorioPrestacao model.
 */
class RelatorioPrestacaoController extends Controller
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
     * Lists all RelatorioPrestacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RelatorioPrestacao::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RelatorioPrestacao model.
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
     * Creates a new RelatorioPrestacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $tipo_anexo)
    {
        $model = new RelatorioPrestacao();
        $projetos = Projeto::find()->all();
        $array_projetos = ArrayHelper::map($projetos, 'id', 'titulo_projeto');

        //atribuindo o id do projeto que foi dado como parâmetro da action, para que o relatorio seja associado ao projeto corretamente
        $model->id_projeto = $id;

        //'1' é relatório técnico e '2' é prestação de contas, como esse é o controller de relatorio técnico, então é sempre '1'
        $model->tipo_anexo = $tipo_anexo;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $model->relatorioFile = UploadedFile::getInstance($model, 'relatorioFile');
          if($model->relatorioFile){
            if ($model->upload()) {
              // file is uploaded successfully
            }else{
              //error message
            }
          }
          if($model->tipo_anexo==1){
            $this->mensagens('success', 'Relatório técnico criado', 'Relatório técnico criado com sucesso.');
            return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
          }
          else if($model->tipo_anexo==2){
            $this->mensagens('success', 'Prestação de contas criado', 'Prestação de contas criado com sucesso.');
            return $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
          }
        }

        return $this->render('create', [
            'model' => $model,
            'array_projetos' => $array_projetos,
            'tipo_anexo' => $tipo_anexo,
        ]);
    }

    /**
     * Updates an existing RelatorioPrestacao model.
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
          $model->relatorioFile = UploadedFile::getInstance($model, 'relatorioFile');
          if($model->relatorioFile){
            if($model->tipo_anexo==1)
              $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');
            else if($model->tipo_anexo==2)
              $path = \Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/');

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
          if($model->tipo_anexo==1){
            $this->mensagens('success', 'Relatório Técnico', 'Alterações realizadas com sucesso.');
            return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
          }else if($model->tipo_anexo==2){
            $this->mensagens('success', 'Prestação de contas financeiras', 'Alterações realizadas com sucesso.');
            return $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
          }
        }

        return $this->render('update', [
            'model' => $model,
            'array_projetos' => $array_projetos,
            'tipo_anexo' => $model->tipo_anexo,
        ]);
    }

    /**
     * Deletes an existing RelatorioPrestacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_projeto = $model->id_projeto;
        $tipo_anexo = $model->tipo_anexo;
        if($tipo_anexo == 1)
          $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');
        else if($tipo_anexo == 2)
          $path = \Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/');

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
        if($tipo_anexo==1){
          $this->mensagens('success', 'Relatório técnico excluído', 'Relatório técnico excluído com sucesso.');
          return $this->redirect(['/projeto/view', 'id' => $id_projeto]);
        }else if($tipo_anexo==2){
          $this->mensagens('success', 'Prestação de contas financeira', 'Prestação de contas financeiras excluído com sucesso.');
          return $this->redirect(['/orcamento/index', 'id_projeto' => $id_projeto]);
        }
    }

    public function actionDeleteanexo($id)
    {
      $this->mensagens('success', 'Anexo', $id);
      $model = $this->findModel($id);
      if($model->tipo_anexo==1)
        $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');
      if($model->tipo_anexo==2)
        $path = \Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          unlink($file);
          if($model->tipo_anexo==1)
            $this->mensagens('success', 'Anexo', 'Relatório técnico excluido com sucesso.');
          else if($model->tipo_anexo==2)
            $this->mensagens('success', 'Anexo', 'Prestação de contas financeira excluida com sucesso.');
        }else{
          if($model->tipo_anexo==1)
            $this->mensagens('error', 'Anexo', 'Nenhum relatório técnico para excluir.');
          else if($model->tipo_anexo==2)
            $this->mensagens('error', 'Anexo', 'Nenhuma prestação de contas para excluir.');
        }
      }else {
        if($model->tipo_anexo==1)
          $this->mensagens('error', 'Anexo', 'Nenhum relatório técnico para excluir.');
        else if($model->tipo_anexo==2)
          $this->mensagens('error', 'Anexo', 'Nenhum prestação de contas para excluir.');
      }

      if($model->tipo_anexo==1)
        return $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
      else if($model->tipo_anexo==2)
        return $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
    }

    public function actionDownload($id){
      $model = $this->findModel($id);

      if($model->tipo_anexo==1)
        $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');
      else if($model->tipo_anexo==2)
        $path = \Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if (file_exists($file)) {
          Yii::$app->response->sendFile($file)->send();
        }else {
          if($model->tipo_anexo==1)
            $this->mensagens('error', 'Relatório técnico', 'Arquivo não encontrado.');
          else if($model->tipo_anexo==2)
            $this->mensagens('error', 'Prestação de contas', 'Arquivo não encontrado.');
        }
      }else {
        if($model->tipo_anexo==1)
          $this->mensagens('error', 'Relatório técnico', 'Arquivo não encontrado.');
        else if($model->tipo_anexo==2)
          $this->mensagens('error', 'Prestação de contas', 'Arquivo não encontrado.');
      }
      if($model->tipo_anexo==1)
        $this->redirect(['/projeto/view', 'id' => $model->id_projeto]);
      else if($model->tipo_anexo==2)
        $this->redirect(['/orcamento/index', 'id_projeto' => $model->id_projeto]);
    }

    /**
     * Finds the RelatorioPrestacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RelatorioPrestacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RelatorioPrestacao::findOne($id)) !== null) {
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
