<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="termo-aditivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero_do_termo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'vigencia')->textInput() ?>

    <?= $form->field($model, 'id_projeto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
