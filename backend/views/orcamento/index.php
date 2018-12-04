<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informações financeiras';
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

    <div class="forms" style="margin-left:25px;">
      <div class="pull-right">
          <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseOrcamento,#collapseValorPago" aria-expanded="false" aria-controls="multiCollapseExample2"
          style="text-align:left">Expandir tudo</button>
      </div>
      <br/>
      <br/>
      <br/>
      <div class="row" >
            <p>
                <a class="btn btn-primary btn-lg" data-toggle="collapse" href="#collapseOrcamento" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
                style="width:95%;text-align:left">
                Orçamento </i>
                </a>
            </p>
            <div class="collapse multi-collapse" id="collapseOrcamento">
                <div class="card card-body">
                    <p>
                        <?= Html::a('Novo', ['create', 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
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
                </div>
            <hr>
        </div>
    </div>

    <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseValorPago" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Valor pago</button>
            </p>
            <div class="collapse multi-collapse" id="collapseValorPago">
                <div class="card card-body">

                    <p>
                        <?= Html::a('Novo', ['valor-pago/create', 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
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
                <hr>
            </div>
        </div>
</div>
