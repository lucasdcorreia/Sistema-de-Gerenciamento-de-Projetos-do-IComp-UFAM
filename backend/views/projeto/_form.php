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

    <?= $form->field($model, 'num_processo', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_protocolo', ['options' => ['class' => 'col-md-6 col-right']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo_projeto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome_coordenador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inicio_previsto', ['options' => ['class' => 'col-md-6 col-left']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'termino', ['options' => ['class' => 'col-md-6 col-right']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'cotacao_moeda_estrangeira')->textInput() ?>

    <?= $form->field($model, 'numero_fapeam_outorga', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publicacao_diario_oficial', ['options' => ['class' => 'col-md-6 col-right']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['projeto/index'], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
