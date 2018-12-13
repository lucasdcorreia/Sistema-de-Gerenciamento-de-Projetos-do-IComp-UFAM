<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projeto-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a(Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Novo', ['create', 'aba' => -1], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
          'style' => 'overflow: auto; word-wrap: break-word;'
        ],
        /*'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'dateFormat' => 'php:d-M-Y',
        'datetimeFormat' => 'php:d/m/Y',
        'timeFormat' => 'php:H:i:s',
        'timeZone' => 'UTC',
      ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'header' => 'Número'],

            'titulo_projeto',
            'nome_coordenador',
            'num_processo',
            'inicio_previsto',//:datetime',
            'termino',//:datetime',
            'duracao',
            //'edital',
            //'num_protocolo',
            //'cotacao_moeda_estrangeira',
            //'numero_fapeam_outorga',
            //'publicacao_diario_oficial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
