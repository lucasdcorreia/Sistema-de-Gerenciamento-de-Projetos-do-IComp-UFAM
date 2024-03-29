<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\RelatorioPrestacao */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
  #relatorioprestacao-relatoriofile {
    opacity: 0;
  }
");

$this->registerJs("
  $('#select-file').click(function(){
    console.log('teste');
     $('#relatorioprestacao-relatoriofile').trigger('click');
  })

  $('#relatorioprestacao-relatoriofile').change(function(){
     $('#val').text(this.value.replace(/C:\\\\fakepath\\\\/i, ''));
  })
");

?>

<div class="relatorio-prestacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<h4 style="font-family: helvetica neue"><strong> Relatório Técnico </strong></h4>-->

    <!--<hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">-->

    <?= $form->field($model, 'data_prevista')->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'data_enviada')->widget(MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'situacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_anexo')->hiddenInput(['tipo_anexo' => 1])->label(false) ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput(['id_projeto' => 0])->label(false) ?>

    <?= $form->field($model, 'relatorioFile', ['options' => ['class' => 'col-md-6 col-left']])->textArea()->label(false)->fileInput() ?>
    <div>
      <input type="button" id='select-file' value="Selecione o Arquivo"></input>
      <span id='val'><?php
        if($tipo_anexo==1)
          $path = \Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/');
        if($tipo_anexo==2)
          $path = \Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '_' . $model->id_projeto . '.*'],
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

    <div class="form-group" style="float: left">
        <?= Html::a('Voltar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
    </div>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
