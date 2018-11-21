<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <?= Html::a('Voltar', ['item/index', 'id_projeto' => $model->id_projeto], ['class' => 'btn btn-default btn-lg']) ?>
    <hr>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['Alterar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Excluir', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'natureza',
            'valor',
            'numero_item',
            'justificativa:ntext',
            'quantidade',
            'custo_unitario',
            'tipo_item',
            'descricao:ntext',
            'id_projeto',
        ],
    ]) ?>

</div>
