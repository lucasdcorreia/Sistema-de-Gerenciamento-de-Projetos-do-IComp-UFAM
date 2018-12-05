<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContaCorrente */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
  #contacorrente-contafile {
    opacity: 0;
  }
");

$this->registerJs("
  $('#select-file').click(function(){
    console.log('teste');
     $('#contacorrente-contafile').trigger('click');
  })

  $('#contacorrente-contafile').change(function(){
     $('#val').text(this.value.replace(/C:\\\\fakepath\\\\/i, ''));
  })
");

?>

<div class="conta-corrente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contaFile', ['options' => ['class' => 'col-md-6 col-left']])->textArea()->label(false)->fileInput() ?>
    <div>
      <input type="button" id='select-file' value="Selecione o Arquivo"></input>
      <span id='val'><?php
        if($tipo_conta_corrente==1)
          $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/');
        else if($tipo_conta_corrente==2)
          $path = \Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/');

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

    <br/>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
