<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */

$this->title = "Termo aditivo: " . $model->numero_do_termo;
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="termo-aditivo-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar', ['/projeto/view', 'id' => $model->id_projeto], ['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </p>

    <?php function existeTermo($model){
      $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

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
    }?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'numero_do_termo',
            'motivo:ntext',
            'vigencia',
            [
              'attribute' => 'valor',
              'label' => 'Valor',
              'format' => 'raw',
              'value' => function($model){
                return 'R$' . ($model->valor);
              },
            ],
            //'id_projeto',
            [
              'attribute' => 'Anexo',
              'label' => 'Anexo',
              'format' => 'raw',
              'value' => function($model){
                return (existeTermo($model) ? Html::a(($model->numero_do_termo!='' ? $model->numero_do_termo : 'Anexo') . ' <i class="fas fa-paperclip" ></i>', ['/termo-aditivo/download', 'id' => $model->id] ) . Html::a(existeTermo($model) ? '| <i class="fa fa-close" ></i> Excluir anexo' : '', ['/termo-aditivo/deleteanexo', 'id' => $model->id] ) : '');
              },
            ],
        ],
    ]) ?>

</div>
