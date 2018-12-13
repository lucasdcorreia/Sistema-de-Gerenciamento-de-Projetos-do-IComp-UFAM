<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conta Correntes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conta-corrente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Conta Corrente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_projeto',
            'banco',
            'agencia',
            'conta',
            //'tipo_conta_corrente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
