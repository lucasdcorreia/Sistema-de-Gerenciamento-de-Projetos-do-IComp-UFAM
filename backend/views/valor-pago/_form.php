<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\ValorPago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valor-pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'numero_ob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'natureza')->dropDownList(['Capital'=>'Capital', 'Custeio'=>'Custeio'], ['prompt' => '--- Selecione a natureza ---']) ?>

    <?= $form->field($model, 'valor')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
