<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */

$this->title = 'Novo Relatório Técnico';
$this->params['breadcrumbs'][] = ['label' => 'Relatório Prestacões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-prestacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
