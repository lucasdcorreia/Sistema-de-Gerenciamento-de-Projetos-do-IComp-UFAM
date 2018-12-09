<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ValorPago */

$this->title = 'Alterar Valor Pago: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Valor Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="valor-pago-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
