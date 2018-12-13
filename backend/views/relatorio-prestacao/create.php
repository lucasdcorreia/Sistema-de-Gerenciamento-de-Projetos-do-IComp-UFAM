<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */
if ($model->tipo_anexo == 1){
	$this->title = 'Novo Relatório Técnico';
	$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
	$this->params['breadcrumbs'][] = $this->title;
}	
else{
	$this->title = 'Nova Prestação de Conta Financeira';
	$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
	$this->params['breadcrumbs'][] = ['label' => 'Informações Financeiras', 'url' => ['orcamento/index', 'id_projeto' => $model->id_projeto]];
	$this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="relatorio-prestacao-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'array_projetos' => $array_projetos,
        'tipo_anexo' => $tipo_anexo,
    ]) ?>

</div>
