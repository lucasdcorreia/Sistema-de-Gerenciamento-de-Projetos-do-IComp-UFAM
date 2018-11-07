<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */

$this->title = "Relatório Técnico: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Relatorio Prestacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="relatorio-prestacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data_prevista',
            'data_enviada',
            'tipo',
            'situacao',
            'tipo_anexo',
            'id_projeto',
        ],
    ]) ?>

</div>
