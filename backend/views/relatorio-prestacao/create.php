<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */

$this->title = 'Create Relatorio Prestacao';
$this->params['breadcrumbs'][] = ['label' => 'Relatorio Prestacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-prestacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
