<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */

$this->title = 'Update Conta Corrente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conta Correntes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conta-corrente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipo_conta_corrente' => $tipo_conta_corrente,
    ]) ?>

</div>
