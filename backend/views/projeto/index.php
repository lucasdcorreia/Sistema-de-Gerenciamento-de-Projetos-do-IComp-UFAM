<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projeto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Projeto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'num_processo',
            'inicio_previsto',
            'termino',
            'nome_coordenador',
            //'edital',
            //'titulo_projeto',
            //'num_protocolo',
            //'cotacao_moeda_estrangeira',
            //'numero_fapeam_outorga',
            //'publicacao_diario_oficial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>