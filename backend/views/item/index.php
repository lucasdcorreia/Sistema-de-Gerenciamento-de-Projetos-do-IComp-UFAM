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
    <div class="center-block" style="width:400px;max-width:100%;">
      <div class="btn-group">
        <?= Html::a('Informações de projeto', ['projeto/view', 'id' => $id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
        <?= Html::a('Itens de projeto', ['item/index', 'id_projeto' => $id_projeto], ['class' => 'btn btn-primary btn-lg']) ?>
      </div>
    </div>
    <hr>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="forms" style="margin-left:25px;">

        <div class="row" >
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseMatConsumo" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Material de Consumo</a>
            </p>
            <div class="collapse multi-collapse" id="collapseMatConsumo">
                <div class="card card-body">
                    <h2>Material de Consumo</h2>
                    <?= GridView::widget([
                    'dataProvider' => $dataProviderMatConsumo,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                            ],
                    ]); ?>
                    <p>
                        <h3>Custo total em material de consumo:  <?php echo $subtotalMatConsumo; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Novo Material de Consumo', ['create', 'tipo_item' => 1, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseMatPermanente" aria-expanded="false" aria-controls="multiCollapseExample2">Material Permanente</button>
            </p>
            <div class="collapse multi-collapse" id="collapseMatPermanente">
                <div class="card card-body">
                <h2>Material Permanente</h2>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderMatPermanente,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <p>
                        <h3>Custo total em material permanente:  <?php echo $subtotalMatPermanente; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Novo Material Permanente', ['create', 'tipo_item' => 2, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>

                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseServTerceiroPF" aria-expanded="false" aria-controls="multiCollapseExample2">Serviço de Terceiro Pessoa Física</button>
            </p>

            <div class="collapse multi-collapse" id="collapseServTerceiroPF">
                <div class="card card-body">
                <h2>Serviço de Terceiro Pessoa Física</h2>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderServTerceiroPF,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'natureza',
                        //'valor',
                        'numero_item',
                        'justificativa:ntext',
                        'quantidade',
                        'custo_unitario',
                        //'tipo_item',
                        'descricao:ntext',
                        //'id_projeto',
                        [
                            'attribute' => 'Valor Total',
                            'value' => function($data){
                                return $data->quantidade * $data->custo_unitario;
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <p>
                        <h3>Custo total em serviços Pessoa Física:  <?php echo $subtotalServTerceiroPF; ?></h3>
                </p>
                <p>
                    <?= Html::a('Novo Serv. de Terceiro Pessoa Física', ['create', 'tipo_item' => 3, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                </p>


                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseServTerceiroPJ" aria-expanded="false" aria-controls="multiCollapseExample2">Serviço de Terceiro Pessoa Jurídica</button>
            </p>

            <div class="collapse multi-collapse" id="collapseServTerceiroPJ">
                <div class="card card-body">
                <h2>Serviço de Terceiro Pessoa Jurídica</h2>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderServTerceiroPJ,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'natureza',
                        //'valor',
                        'numero_item',
                        'justificativa:ntext',
                        'quantidade',
                        'custo_unitario',
                        //'tipo_item',
                        'descricao:ntext',
                        //'id_projeto',
                        [
                            'attribute' => 'Valor Total',
                            'value' => function($data){
                                return $data->quantidade * $data->custo_unitario;
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <p>
                        <h3>Custo total em serviços Pessoa Jurídica:  <?php echo $subtotalServTerceiroPJ; ?></h3>
                </p>
                <p>
                    <?= Html::a('Novo Serv. de Terceiro Pessoa Jurídica', ['create', 'tipo_item' => 4, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                </p>

                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsePassagemNacional" aria-expanded="false" aria-controls="multiCollapseExample2">Passagem Nacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapsePassagemNacional">
                <div class="card card-body">
                    <h2>Passagem Nacional</h2>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPassagemNacional,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <p>
                        <h3>Custo total em Passagem Nacional:  <?php echo $subtotalPassagemNacional; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Nova Passagem Nacional', ['create', 'tipo_item' => 5, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsePassagemInternacional" aria-expanded="false" aria-controls="multiCollapseExample2">Passagem Internacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapsePassagemInternacional">

                <div class="card card-body">
                    <h2>Passagem Internacional</h2>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPassagemInternacional,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <p>
                        <h3>Custo total em Passagem Internacional:  <?php echo $subtotalPassagemInternacional; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Nova Passagem Internacional', ['create', 'tipo_item' => 6, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>

                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDiariaNacional" aria-expanded="false" aria-controls="multiCollapseExample2">Diária Nacional</button>
            </p>

            <div class="collapse multi-collapse" id="collapseDiariaNacional">
                <div class="card card-body">
                    <h2>Diária Nacional</h2>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderDiariaNacional,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <p>
                        <h3>Custo total em Diárias Nacionais:  <?php echo $subtotalDiariaNacional; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Nova Diária Nacional', ['create', 'tipo_item' => 7, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>

                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDiariaInternacional" aria-expanded="false" aria-controls="multiCollapseExample2">Diária Internacional</button>
            </p>
            <div class="collapse multi-collapse" id="collapseDiariaInternacional">
                <div class="card card-body">
                    <h2>Diária Internacional  </h2>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderDiariaInternacional,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'natureza',
                            //'valor',
                            'numero_item',
                            'justificativa:ntext',
                            'quantidade',
                            'custo_unitario',
                            //'tipo_item',
                            'descricao:ntext',
                            //'id_projeto',
                            [
                                'attribute' => 'Valor Total',
                                'value' => function($data){
                                    return $data->quantidade * $data->custo_unitario;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn',],
                        ],
                    ]); ?>
                    <p>
                        <h3>Custo total em Diárias Internacionais:  <?php echo $subtotalDiariaInternacional; ?></h3>
                    </p>
                    <p>
                        <?= Html::a('Nova Diária Internacional', ['create', 'tipo_item' => 8, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
                    </p>

                </div>
                <hr>
            </div>
        </div>

    </div>

</div>
