<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */

$this->title = 'Nova Conta Corrente';
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['projeto/view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = ['label' => 'Informações Financeiras', 'url' => ['orcamento/index', 'id_projeto' => $model->id_projeto]];
//$this->params['breadcrumbs'][] = ['label' => 'Contas Correntes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conta-corrente-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'tipo_conta_corrente' => $tipo_conta_corrente,
    ]) ?>

</div>
