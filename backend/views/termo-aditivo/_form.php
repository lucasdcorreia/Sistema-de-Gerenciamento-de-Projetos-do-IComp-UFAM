<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="termo-aditivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <h4 style="font-family: helvetica neue"><strong> Termo Aditivo </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= $form->field($model, 'numero_do_termo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'vigencia')->textInput() ?> -->

    <?= $form->field($model, 'vigencia')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'id_projeto')->dropDownList($array_projetos) ?>

    <div class="form-group">
        <?= Html::submitButton('Adicionar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
