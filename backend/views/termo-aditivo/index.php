<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Projeto;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Termos Aditivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="termo-aditivo-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Novo termo aditivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
          'style' => 'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'numero_do_termo',
            'motivo:ntext',
            'vigencia',
/*          [
                'attribute' => 'id_projeto',
                'value' => function ($data) {
                    return Projeto::findOne($data->id_projeto)->titulo_projeto;
                },
            ],
*/
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
