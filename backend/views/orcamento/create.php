<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */

$this->title = 'Novo Orçamento';
$this->params['breadcrumbs'][] = ['label' => 'Orçamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orcamento-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
