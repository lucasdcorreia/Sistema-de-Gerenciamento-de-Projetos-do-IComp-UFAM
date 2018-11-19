<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            //'quantidade',
            //'custo_unitario',
            //'tipo_item',
            //'descricao:ntext',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
