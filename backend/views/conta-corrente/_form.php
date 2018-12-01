<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conta-corrente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_projeto')->textInput() ?>

    <?= $form->field($model, 'banco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_conta_corrente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
