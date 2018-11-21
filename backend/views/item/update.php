<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

if($model->tipo_item == 1)
  $this->title = 'Alterar Material de Consumo';
else if($model->tipo_item == 2)
  $this->title = 'Alterar Material Permanente';
else if($model->tipo_item == 3)
  $this->title = 'Alterar Serviço de Terceiros Pessoa Física';
else if($model->tipo_item == 4)
  $this->title = 'Alterar Serviço de Terceiro Pessoa Jurídica';
else if($model->tipo_item == 5)
  $this->title = 'Alterar Passagem Nacional';
else if($model->tipo_item == 6)
  $this->title = 'Alterar Passagem Internacional';
else if($model->tipo_item == 7)
  $this->title = 'Alterar Diária Nacional';
else if($model->tipo_item == 8)
  $this->title = 'Alterar Diária Internacional';

$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'tipo_item' => $model->tipo_item,
        'id_projeto' => $model->id_projeto,
        'model' => $model,
    ]) ?>

</div>
