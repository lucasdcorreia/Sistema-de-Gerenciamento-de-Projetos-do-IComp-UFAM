<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

    <h2>Material de Consumo</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderMatConsumo,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Novo Material de Consumo', ['create', 'tipo_item' => 1, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>


    <h2>Material Permanente</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderMatPermanente,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Novo Material Permanente', ['create', 'tipo_item' => 2, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>

    <h2>Serviço de Terceiro Pessoa Física</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderServTerceiroPF,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Novo Serv. de Terceiro Pessoa Física', ['create', 'tipo_item' => 3, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>


    <h2>Serviço de Terceiro Pessoa Jurídica</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderServTerceiroPJ,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Novo Serv. de Terceiro Pessoa Jurídica', ['create', 'tipo_item' => 4, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>


    <h2>Passagem Nacional</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderPassagemNacional,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Nova Passagem Nacional', ['create', 'tipo_item' => 5, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>

    <h2>Passagem Internacional</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderPassagemInternacional,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Nova Passagem Internacional', ['create', 'tipo_item' => 6, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>


    <h2>Diária Nacional</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderDiariaNacional,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Nova Diária Nacional', ['create', 'tipo_item' => 7, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>

    <h2>Diária Internacional  </h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderDiariaInternacional,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            //'tipo_item',
            'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]); ?>
    <p>
        <?= Html::a('Nova Diária Internacional', ['create', 'tipo_item' => 8, 'id_projeto' => $id_projeto], ['class' => 'btn btn-success']) ?>
    </p>



</div>
