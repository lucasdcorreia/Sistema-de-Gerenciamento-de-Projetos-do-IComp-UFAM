<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */

$this->title = 'Novo termo aditivo';
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="termo-aditivo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'array_projetos' => $array_projetos,
    ]) ?>

</div>
