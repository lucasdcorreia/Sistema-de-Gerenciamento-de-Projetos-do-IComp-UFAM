<?php

use yii\helpers\Html;
use lo\widgets\Toggle;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Editar Usuário ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'label' => 'Alterar',
    ]) ?>

</div>
