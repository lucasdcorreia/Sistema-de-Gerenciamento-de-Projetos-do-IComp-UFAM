<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orcamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orcamento-index">

    <!--Style foi usado pois na versão 3.3 a classe center block só funciona com o style width-->
    <div class="center-block" style="width:600px;max-width:100%;">
      <div class="btn-group">
        <?= Html::a('Informações de projeto', ['projeto/view', 'id' => $id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
        <?= Html::a('Itens de projeto', ['item/index', 'id_projeto' => $id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
        <?= Html::a('Informações financeiras', ['orcamento/index', 'id_projeto' => $id_projeto], ['class' => 'btn btn-primary btn-lg']) ?>
      </div>
    </div>
    <hr>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orcamento', ['create', 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_projeto',
            'recurso_aprovado',
            'tipo_de_parcela',
            'valor_parcela',
            //'data_recebida',
            //'valor_receber',
        ],
    ]); ?>

    <p>
        <?= Html::a('Create Valor Pago', ['valor-pago/create', 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderValorPago,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_projeto',
            'numero_ob',
            'data',
            'natureza',
            //'valor',
            //'tipo',

            ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Exibir'),
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Alterar'),
                                'data-method' => 'post'
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Excluir'),
                                'data' => [
                                                'confirm' => 'Deseja realmente excluir este item?',
                                                'method' => 'post',
                                ],
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='index.php?r=valor-pago/view&id='.$model->id;
                    return $url;
                }

                if ($action === 'update') {
                    $url ='index.php?r=valor-pago/update&id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='index.php?r=valor-pago/delete&id='.$model->id;
                    return $url;
                }

            }
            ]
        ],
    ]); ?>
</div>
