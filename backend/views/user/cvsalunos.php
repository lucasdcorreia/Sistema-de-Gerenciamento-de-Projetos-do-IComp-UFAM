<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Upload CSV da Lista de Alunos';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>CSV da Lista de Alunos</b></h3>
		</div>
		<div class="panel-body">
			<?= $form->field($model, 'csvAlunosFile', ['options' => ['class' => 'col-md-6']])->fileInput(['accept' => '.xml'])->label("<div><b>CSV da Lista de Alunos:</b></div>") ?>
			<?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>

<?php ActiveForm::end() ?>