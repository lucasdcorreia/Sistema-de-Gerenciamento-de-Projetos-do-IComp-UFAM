<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */

$this->title = 'Alterar Conta Corrente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conta Corrente', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="conta-corrente-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'tipo_conta_corrente' => $tipo_conta_corrente,
    ]) ?>

</div>
