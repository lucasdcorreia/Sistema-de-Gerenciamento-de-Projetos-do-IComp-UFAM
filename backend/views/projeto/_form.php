<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projeto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projeto-form">

    <?php $form = ActiveForm::begin([
      'id' => 'projeto'
    ]); ?>

    <?= $form->field($model, 'num_processo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_protocolo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo_projeto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome_coordenador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inicio_previsto')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'yyyy/mm/dd']]) ?>

    <?= $form->field($model, 'termino')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'yyyy/mm/dd']]) ?>

    <?= $form->field($model, 'cotacao_moeda_estrangeira')->textInput() ?>

    <?= $form->field($model, 'numero_fapeam_outorga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publicacao_diario_oficial')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'yyyy/mm/dd']]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
