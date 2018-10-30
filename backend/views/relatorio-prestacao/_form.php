<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-prestacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_prevista')->textInput() ?>

    <?= $form->field($model, 'data_enviada')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'situacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_anexo')->textInput() ?>

    <?= $form->field($model, 'id_projeto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
