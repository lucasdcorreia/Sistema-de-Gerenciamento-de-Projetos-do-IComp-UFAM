<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskMoney;
use yii\bootstrap\Collapse;


/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'natureza')->dropDownList(['Capital'=>'Capital', 'Custeio'=>'Custeio'], ['prompt' => '--- Selecione a natureza ---']) ?>

  <?= $form->field($model, 'professor_responsavel')->dropDownList($professores_nomes) ?>

    <?= $form->field($model, 'numero_item')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'justificativa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?php if (($tipo_item == 6) || ($tipo_item == 8)): ?>
        <?= $form->field($model, 'custo_unitario')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'US$', 'thousands' => '.', 'decimal' => ','] ]) ?>
    <?php else: ?>
        <?= $form->field($model, 'custo_unitario')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'tipo_item')->hiddenInput(['tipo_item' => $tipo_item])->label(false); ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput(['id_projeto' => $id_projeto])->label(false); ?>

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
