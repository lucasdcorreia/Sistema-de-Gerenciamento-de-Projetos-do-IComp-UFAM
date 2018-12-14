<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */

$this->title = 'Orçamento';
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = ['label' => 'Informações Financeiras', 'url' => ['orcamento/index', 'id_projeto' => $model->id_projeto]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orcamento-view">

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
        <?= Html::a('Voltar', ['orcamento/index', 'id_projeto' => $model->id_projeto], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_projeto',
            [
              'attribute' => 'recurso_aprovado',
              'label' => 'Recurso Aprovado',
              'format' => 'raw',
              'value' => function($model){
                  return 'R$' . ($model->recurso_aprovado);
              },
            ],

            'tipo_de_parcela',
            [
              'attribute' => 'valor_parcela',
              'label' => 'Valor da Parcela',
              'format' => 'raw',
              'value' => function($model){
                  return 'R$' . ($model->valor_parcela);
              },
            ],
            'data_recebida',
            [
            'attribute' => 'valor_receber',
            'label' => 'Valor a Receber',
            'format' => 'raw',
            'value' => function($model){
                return 'R$' . ($model->valor_receber);
              },
            ],
        ],
    ]) ?>

</div>
