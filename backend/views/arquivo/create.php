<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Arquivo */

$this->title = 'Create Arquivo';
$this->params['breadcrumbs'][] = ['label' => 'Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arquivo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
