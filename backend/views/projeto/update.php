<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projeto */

$this->title = 'Alterar Projeto: ' . $model->titulo_projeto;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar Projeto';
?>
<div class="projeto-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'id_projeto' => $model->id,
    ]) ?>

</div>
