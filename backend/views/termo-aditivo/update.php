<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */

$this->title = 'Alterar Termo Aditivo: ' . $model->numero_do_termo;
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar Termo Aditivo';
?>
<div class="termo-aditivo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'array_projetos' => $array_projetos,
    ]) ?>

</div>
