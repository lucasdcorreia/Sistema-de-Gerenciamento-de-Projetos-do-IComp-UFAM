<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */


if($tipo_item == 1)
  $this->title = 'Novo Material de Consumo';
else if($tipo_item == 2)
  $this->title = 'Novo Material Permanente';
else if($tipo_item == 3)
  $this->title = 'Novo Serviço de Terceiros Pessoa Física';
else if($tipo_item == 4)
  $this->title = 'Novo Serviço de Terceiro Pessoa Jurídica';
else if($tipo_item == 5)
  $this->title = 'Nova Passagem Nacional';
else if($tipo_item == 6)
  $this->title = 'Nova Passagem Internacional';
else if($tipo_item == 7)
  $this->title = 'Nova Diária Nacional';
else if($tipo_item == 8)
  $this->title = 'Nova Diária Internacional';

$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $id_projeto]];
$this->params['breadcrumbs'][] = ['label' => 'Itens', 'url' => ['item/index', 'id_projeto' => $model->id_projeto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'tipo_item' => $tipo_item,
        'id_projeto' => $id_projeto,
        'model' => $model,
        'professores_nomes' => $professores_nomes,
    ]) ?>

</div>
