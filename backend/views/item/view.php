<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model common\models\Item */

if($model->tipo_item == 1)
  $this->title = 'Material de Consumo';
else if($model->tipo_item == 2)
  $this->title = 'Material Permanente';
else if($model->tipo_item == 3)
  $this->title = 'Serviço de Terceiros Pessoa Física';
else if($model->tipo_item == 4)
  $this->title = 'Serviço de Terceiro Pessoa Jurídica';
else if($model->tipo_item == 5)
  $this->title = 'Passagem Nacional';
else if($model->tipo_item == 6)
  $this->title = 'Passagem Internacional';
else if($model->tipo_item == 7)
  $this->title = 'Diária Nacional';
else if($model->tipo_item == 8)
  $this->title = 'Diária Internacional';

$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = ['label' => 'Itens', 'url' => ['item/index', 'id_projeto' => $model->id_projeto]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <hr>

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
        <?= Html::a('Voltar', ['item/index', 'id_projeto' => $model->id_projeto], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => ($model->tipo_item==8 || $model->tipo_item==6)?[
            //'id',
            'natureza',
            //'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            [
              'attribute' => 'custo_unitario',
              'label' => 'Custo Unitário',
              'format' => 'raw',
              'value' => function($model){
                  return 'US$' . ($model->custo_unitario);
              },
            ],
            [
              'attribute' => 'custoUnitarioReal',
              'label' => 'Custo Unitário (R$)',
              'format' => 'raw',
              'value' => function($model){
                  return 'R$' . ($model->custoUnitarioReal);
              },
            ],
            //'tipo_item',
            'descricao:ntext',
            'professor_responsavel',
            //'id_projeto',
            /*[
                'attribute' => 'professor_responsavel',
                'value' => function($data){
                    return User::findOne($data->professor_responsavel)->nome;
                }
            ]*/
        ]:[
          //'id',
          'natureza',
          //'valor',
          'numero_item',
          'justificativa:ntext',
          'quantidade',
          [
            'attribute' => 'custo_unitario',
            'label' => 'Custo Unitário',
            'format' => 'raw',
            'value' => function($model){
                return 'R$' . ($model->custo_unitario);
            },
          ],
          //'custoUnitarioReal',
          //'tipo_item',
          'descricao:ntext',
          'professor_responsavel',
          //'id_projeto',
          /*[
              'attribute' => 'professor_responsavel',
              'value' => function($data){
                  return User::findOne($data->professor_responsavel)->nome;
              }
          ]*/
        ],
    ]) ?>

</div>
