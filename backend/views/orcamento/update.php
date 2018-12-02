<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */

$this->title = 'Update Orcamento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orcamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orcamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
