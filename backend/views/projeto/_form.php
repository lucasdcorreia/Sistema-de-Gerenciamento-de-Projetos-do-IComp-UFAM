<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use yii\widgets\MaskMoney;

/* @var $this yii\web\View */
/* @var $model common\models\Projeto */
/* @var $form yii\widgets\ActiveForm */

//$modelTermoAditivo = new common\models\TermoAditivo;

$this->registerCss("
  #projeto-editalfile {
    opacity: 0;
  }

  #projeto-tituloprojetofile {
    opacity: 0;
  }
");

$this->registerJs("
  $('#select-file').click(function(){
    console.log('teste');
     $('#projeto-editalfile').trigger('click');
  })

  $('#projeto-editalfile').change(function(){
     $('#val').text(this.value.replace(/C:\\\\fakepath\\\\/i, ''));
  })

  $('#select-file1').click(function(){
    console.log('teste');
     $('#projeto-tituloprojetofile').trigger('click');
  })

  $('#projeto-tituloprojetofile').change(function(){
     $('#val1').text(this.value.replace(/C:\\\\fakepath\\\\/i, ''));
  })
");

?>



<div class="projeto-form">


    <?php $form = ActiveForm::begin([
      'id' => 'projeto',
      'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <!--Style foi usado pois na versão 3.3 a classe center block só funciona com o style width-->
    <div class="center-block" style="width:800px;max-width:100%;">
      <div class="btn-group">
        <?= Html::submitButton('Informações de projeto', ['class' => 'btn btn-primary btn-lg', 'name'=>'aba', 'value' => 0]) ?>
        <?= Html::submitButton('Itens de projeto', ['class' => 'btn btn-default btn-lg', 'name'=>'aba', 'value' => 1]) ?>
        <?= Html::submitButton('Informações financeiras', ['class' => 'btn btn-default btn-lg', 'name'=>'aba', 'value' => 2]) ?>
      </div>
    </div>
    <hr>

    <h4 style="font-family: helvetica neue"><strong> Identificação </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= $form->field($model, 'titulo_projeto', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tituloProjetoFile', ['options' => ['class' => 'col-md-6 col-left']])->textArea()->label(false)->fileInput() ?>
    <div>
      <input type="button" id='select-file1' value="Selecione o Arquivo"></input>
      <span id='val1'><?php
        $path = \Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if(file_exists($file)) {
            if(basename($file)!='.gitignore')echo basename($file);
            else echo 'Escolha um arquivo';
          }else{
            echo 'Escolha um arquivo';
          }
        }else echo 'Escolha um arquivo';
      ?></span>
    </div>

    <br>

    <?= $form->field($model, 'nome_coordenador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_processo', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_protocolo', ['options' => ['class' => 'col-md-6 col-right']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edital', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'editalFile', ['options' => ['class' => 'col-md-6 col-left']])->textArea()->label(false)->fileInput() ?>
    <div>
      <input type="button" id='select-file' value="Selecione o Arquivo"></input>
      <span id='val'><?php
        $path = \Yii::getAlias('@backend/../uploads/projetos/edital/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if(file_exists($file)) {
            if(basename($file)!='.gitignore')echo basename($file);
            else echo 'Escolha um arquivo';
          }else{
            echo 'Escolha um arquivo';
          }
        }else echo 'Escolha um arquivo';
      ?></span>
    </div>

    <br>

    <?= $form->field($model, 'inicio_previsto', ['options' => ['class' => 'col-md-6 col-left']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'termino', ['options' => ['class' => 'col-md-6 col-right']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'cotacao_moeda_estrangeira')->widget(\kartik\money\MaskMoney::class,['pluginOptions' => ['prefix' => 'R$', 'thousands' => '.', 'decimal' => ','] ]) ?>

    <br/>

    <h4 style="font-family: helvetica neue"><strong> Termo de Outorga </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= $form->field($model, 'numero_fapeam_outorga')->textInput(['maxlength' => true]) ?>

<!--    <?= $form->field($model, 'publicacao_diario_oficial', ['options' => ['class' => 'col-md-6 col-right']])->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>
-->

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar', ['projeto/index'], ['class'=>'btn btn-default']) ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success', 'name'=>'aba', 'value'=>0]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
