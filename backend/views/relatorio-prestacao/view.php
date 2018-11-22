<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */

$this->title = "Relatório Técnico: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Relatorio Prestacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="relatorio-prestacao-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </p>
    <?php
    function existeRelatorio($model){
      $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');

      $files = \yii\helpers\FileHelper::findFiles($path, [
        'only' => [$model->id . '_' . $model->id_projeto . '.*'],
      ]);
      if (isset($files[0])) {
        $file = $files[0];

        if(file_exists($file)) {
          return true;
        }else{
          return false;
        }
      }
    }
  ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'data_prevista',
            'data_enviada',
            'tipo',
            'situacao',
            //'tipo_anexo',
            //'id_projeto',
            [
              'attribute' => 'Anexo',
              'label' => 'Anexo',
              'format' => 'raw',
              'value' => function($model){
                return (existeRelatorio($model) ? Html::a(($model->tipo!='' ? $model->tipo : 'Anexo') . ' <i class="fas fa-paperclip" ></i>', ['/relatorio-prestacao/download', 'id' => $model->id] ) . Html::a(existeRelatorio($model) ? '| <i class="fa fa-close" ></i> Excluir anexo' : '', ['/relatorio-prestacao/deleteanexo', 'id' => $model->id] ) : '');
              },
            ],
        ],
    ]) ?>

</div>
