<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\Item;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Itens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <!--Style foi usado pois na versão 3.3 a classe center block só funciona com o style width-->
    <div class="center-block" style="width:600px;max-width:100%;">
      <div class="btn-group">
        <?= Html::a('Informações de projeto', ['projeto/view', 'id' => $id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
        <?= Html::a('Itens de projeto', ['item/index', 'id_projeto' => $id_projeto], ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::a('Informações financeiras', ['orcamento/index', 'id_projeto' => $id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
      </div>
    </div>
    <hr>

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <div class="forms" style="margin-left:25px;">
      <div class="pull-right">
          <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseServTerceiroPF,#collapseServTerceiroPJ,#collapseMatConsumo,#collapseMatPermanente,#collapseDiariaNacional,#collapsePassagemNacional,#collapseDiariaInternacional,#collapsePassagemInternacional" aria-expanded="false" aria-controls="multiCollapseExample2"
          style="text-align:left">Expandir tudo</button>
      </div>
      <br/>
      <br/>
      <br/>
        <!-- Material de Consumo -->
        <div class="row" >
            <p>
                <a class="btn btn-primary btn-lg" data-toggle="collapse" href="#collapseMatConsumo" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
                style="width:95%;text-align:left">
                Material de Consumo </i>
                </a>
            </p>
            <div class="collapse multi-collapse" id="collapseMatConsumo">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em material de consumo:  <?php echo 'R$ ' .  number_format($subtotalMatConsumo, 2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Novo', ['create', 'tipo_item' => 1, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']); ?></h4>
                  </p>
                    <?= GridView::widget([
                    'dataProvider' => $dataProviderMatConsumo,
                    'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custo_unitario;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',

                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'R$' . number_format($data->quantidade * $data->custo_unitario, 2);
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                            ],
                    ]); ?>
                </div>
                <hr>
            </div>
        </div>

        <!-- Material Permanente -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseMatPermanente" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Material Permanente</button>
            </p>
            <div class="collapse multi-collapse" id="collapseMatPermanente">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em material permanente:  <?php echo 'R$ ' .  number_format($subtotalMatPermanente, 2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Novo', ['create', 'tipo_item' => 2, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderMatPermanente,
                        'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custo_unitario;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',
                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'R$' . number_format($data->quantidade * $data->custo_unitario, 2);
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
                <hr>
            </div>
        </div>

        <!-- Serviço de Terceiro Pessoa Física -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseServTerceiroPF" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Serviço de Terceiro Pessoa Física</button>
            </p>

            <div class="collapse multi-collapse" id="collapseServTerceiroPF">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em serviços Pessoa Física:  <?php echo 'R$ ' .  number_format($subtotalServTerceiroPF, 2) . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Novo', ['create', 'tipo_item' => 3, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderServTerceiroPF,
                    'columns' => [
                        'numero_item',
                        'natureza',
                        //'valor',
                        //'justificativa:ntext',
                        'quantidade',
                        [
                            'attribute' => 'Custo Unitário',
                            'value' => function($data){
                                return 'R$' . $data->custo_unitario;
                            }
                        ],
                        //'tipo_item',
                        //'descricao:ntext',
                        'professor_responsavel',
                        //'id_projeto',
                        [
                            'attribute' => 'Total',
                            'value' => function($data){
                                return 'R$' . number_format($data->quantidade * $data->custo_unitario, 2, ",", '.');
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


                </div>
                <hr>
            </div>
        </div>

        <!-- Serviço de Terceiro Pessoa Jurídica -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseServTerceiroPJ" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Serviço de Terceiro Pessoa Jurídica</button>
            </p>

            <div class="collapse multi-collapse" id="collapseServTerceiroPJ">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em serviços Pessoa Jurídica:  <?php echo 'R$ ' .  number_format($subtotalServTerceiroPJ, 2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Novo', ['create', 'tipo_item' => 4, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderServTerceiroPJ,
                    'columns' => [
                        'numero_item',
                        'natureza',
                        //'valor',
                        //'justificativa:ntext',
                        'quantidade',
                        [
                            'attribute' => 'Custo Unitário',
                            'value' => function($data){
                                return 'R$' . $data->custo_unitario;
                            }
                        ],
                        //'tipo_item',
                        //'descricao:ntext',
                        'professor_responsavel',
                        //'id_projeto',
                        [
                            'attribute' => 'Total',
                            'value' => function($data){
                                return 'R$' . number_format($data->quantidade * $data->custo_unitario,2);
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                </div>
                <hr>
            </div>
        </div>

        <!-- Passagem Nacional -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapsePassagemNacional" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Passagem Nacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapsePassagemNacional">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em Passagem Nacional:  <?php echo 'R$ ' .  number_format($subtotalPassagemNacional, 2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Nova', ['create', 'tipo_item' => 5, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPassagemNacional,
                        'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custo_unitario;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',
                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'R$' . number_format($data->quantidade * $data->custo_unitario, 2, ",", '.');
                                }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
                <hr>
            </div>
        </div>

        <!-- Passagem Internacional -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapsePassagemInternacional" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Passagem Internacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapsePassagemInternacional">

                <div class="card card-body">
                  <p>
                    <h4>Custo total em Passagem Internacional:  <?php echo 'US$ ' .  number_format($subtotalPassagemInternacional,2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Nova', ['create', 'tipo_item' => 6, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPassagemInternacional,
                        'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário (US$)',
                                'value' => function($data){
                                    return 'US$' . $data->custo_unitario;
                                }
                            ],
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custoUnitarioReal;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',
                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'US$' . $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            [
                                'attribute' => 'Total R$',
                                'value' => function($data){
                                    return 'R$' . $data->quantidade * $data->custoUnitarioReal;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
                <hr>
            </div>
        </div>

        <!-- Diária Nacional -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseDiariaNacional" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Diária Nacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapseDiariaNacional">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em Diárias Nacionais:  <?php echo 'R$ ' .  number_format($subtotalDiariaNacional,2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Nova', ['create', 'tipo_item' => 7, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderDiariaNacional,
                        'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custo_unitario;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',
                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'R$' . $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
                <hr>
            </div>
        </div>

        <!-- Diária Internacional -->
        <div class="row">
            <p>
                <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseDiariaInternacional" aria-expanded="false" aria-controls="multiCollapseExample2"
                style="width:95%;text-align:left">Diária Internacional</button>
            </p>
            <div class="collapse multi-collapse" id="collapseDiariaInternacional">
                <div class="card card-body">
                  <p>
                    <h4>Custo total em Diárias Internacionais:  <?php echo 'US$ ' .  number_format($subtotalDiariaInternacional,2, ",", '.') . ' ' .
                    Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Nova', ['create', 'tipo_item' => 8, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?></h4>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderDiariaInternacional,
                        'columns' => [
                            'numero_item',
                            'natureza',
                            //'valor',
                            //'justificativa:ntext',
                            'quantidade',
                            [
                                'attribute' => 'Custo Unitário (US$)',
                                'value' => function($data){
                                    return 'US$' . $data->custo_unitario;
                                }
                            ],
                            [
                                'attribute' => 'Custo Unitário',
                                'value' => function($data){
                                    return 'R$' . $data->custo_unitario;
                                }
                            ],
                            //'tipo_item',
                            //'descricao:ntext',
                            'professor_responsavel',
                            //'id_projeto',
                            [
                                'attribute' => 'Total',
                                'value' => function($data){
                                    return 'US$' . $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            [
                                'attribute' => 'Total R$',
                                'value' => function($data){
                                    return 'R$' . $data->quantidade * $data->custoUnitarioReal;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn',],
                        ],
                    ]); ?>

                </div>
                <hr>
            </div>
        </div>

    </div>


</div>
