<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orcamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'recurso_aprovado')->textInput() ?>

    <?= $form->field($model, 'tipo_de_parcela')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_parcela')->textInput() ?>

    <?= $form->field($model, 'data_recebida')->textInput() ?>

    <?= $form->field($model, 'valor_receber')->textInput() ?>

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
