<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ValorPago */

$this->title = 'Create Valor Pago';
$this->params['breadcrumbs'][] = ['label' => 'Valor Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valor-pago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
