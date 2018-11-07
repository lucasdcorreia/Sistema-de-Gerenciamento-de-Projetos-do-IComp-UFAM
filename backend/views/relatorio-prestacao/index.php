<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relatórios Técnicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-prestacao-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Novo relatório técnico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_prevista',
            'data_enviada',
            'tipo',
            'situacao',
            //'tipo_anexo',
            //'id_projeto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
