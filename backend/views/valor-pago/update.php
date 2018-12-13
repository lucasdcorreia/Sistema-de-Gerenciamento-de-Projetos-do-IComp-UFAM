<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ValorPago */

$this->title = 'Alterar Valor Pago: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = ['label' => 'Informações Financeiras', 'url' => ['orcamento/index', 'id_projeto' => $model->id_projeto]];
//$this->params['breadcrumbs'][] = ['label' => 'Valor Pagos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar Valor Pago';
?>
<div class="valor-pago-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
