<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-prestacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <h4 style="font-family: helvetica neue"><strong> Relatório Técnico </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= $form->field($modelRelatorioPrestacao, 'data_prevista', ['options' => ['class' => 'col-md-3 col-left']])->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($modelRelatorioPrestacao, 'data_enviada', ['options' => ['class' => 'col-md-3 col-left']])->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($modelRelatorioPrestacao, 'tipo', ['options' => ['class' => 'col-md-3 col-left']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelRelatorioPrestacao, 'situacao', ['options' => ['class' => 'col-md-3 col-left']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Adicionar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>