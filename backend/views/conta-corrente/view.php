<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */
if ($model->tipo_conta_corrente == 1){
    $this->title = 'Conta Corrente para Desembolso de Recursos';
}
else{
    $this->title = 'Conta Corrente para Recolhimento de Saldo';
    $this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
    $this->params['breadcrumbs'][] = ['label' => 'Informações Financeiras', 'url' => ['orcamento/index', 'id_projeto' => $model->id_projeto]];
    //$this->params['breadcrumbs'][] = ['label' => 'Conta Corrente', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;   
}

\yii\web\YiiAsset::register($this);
?>
<div class="conta-corrente-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar', ['orcamento/index', 'id_projeto' => $model->id_projeto], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_projeto',
            'banco',
            'agencia',
            'conta',
            //'tipo_conta_corrente',
        ],
    ]) ?>

</div>
