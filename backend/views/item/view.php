<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = $model->natureza;
$this->params['breadcrumbs'][] = ['label' => 'Itens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <?= Html::a('Voltar', ['item/index', 'id_projeto' => $model->id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
    <hr>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => ($model->tipo_item==8 || $model->tipo_item==6)?[
            'id',
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            'custoUnitarioReal',
            //'tipo_item',
            'descricao:ntext',

            //'id_projeto',
            /*[
                'attribute' => 'professor_responsavel',
                'value' => function($data){
                    return User::findOne($data->professor_responsavel)->nome;
                }
            ]*/
        ]:[
          'id',
          'natureza',
          'valor',
          'numero_item',
          'justificativa:ntext',
          'quantidade',
          'custo_unitario',
          //'custoUnitarioReal',
          'tipo_item',
          'descricao:ntext',

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
