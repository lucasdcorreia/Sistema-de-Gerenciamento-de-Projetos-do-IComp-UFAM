<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Arquivo */

$this->title = 'Alterar Arquivo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
//$this->params['breadcrumbs'][] = ['label' => 'Arquivos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar Arquivo';
?>
<div class="arquivo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
