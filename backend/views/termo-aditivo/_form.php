<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TermoAditivo */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
  #termoaditivo-termofile {
    opacity: 0;
  }
");

$this->registerJs("
  $('#select-file').click(function(){
    console.log('teste');
     $('#termoaditivo-termofile').trigger('click');
  })

  $('#termoaditivo-termofile').change(function(){
     $('#val').text(this.value.replace(/C:\\\\fakepath\\\\/i, ''));
  })
");




?>

<div class="termo-aditivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <h4 style="font-family: helvetica neue"><strong> Termo Aditivo </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= $form->field($model, 'numero_do_termo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'vigencia')->textInput() ?> -->

    <?= $form->field($model, 'vigencia')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'dd/mm/yyyy']]) ?>

    <?= $form->field($model, 'id_projeto')->hiddenInput(['id_projeto' => 0])->label(false) ?>

    <?= $form->field($model, 'termoFile', ['options' => ['class' => 'col-md-6 col-left']])->textArea()->label(false)->fileInput() ?>
    <div>
      <input type="button" id='select-file' value="Selecione o Arquivo"></input>
      <span id='val'><?php
        $path = \Yii::getAlias('@backend/../uploads/projetos/termo_aditivo/');

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
        }
      ?></span>
    </div>

    <br>



    <div class="form-group" style="text-align: right">
        <?= Html::a('Cancelar','#',['class' => 'btn btn-default','onclick'=>"history.go(-1);"]); ?>
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
