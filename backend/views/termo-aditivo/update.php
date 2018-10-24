<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */

$this->title = 'Update Termo Aditivo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Termo Aditivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="termo-aditivo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
