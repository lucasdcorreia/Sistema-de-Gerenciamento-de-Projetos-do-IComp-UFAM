<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Orcamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orcamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'recurso_aprovado')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <?= $form->field($model, 'tipo_de_parcela')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_parcela')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <?= $form->field($model, 'data_recebida')->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'valor_receber')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
