<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Upload CSV de Disciplinas';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>CSV de Disciplinas</b></h3>
		</div>
		<div class="panel-body">
			<?= $form->field($model, 'csvDisciplinasFile', ['options' => ['class' => 'col-md-6']])->fileInput(['accept' => '.csv'])->label("<div><b>CSV de Disciplinas do IComp:</b></div>") ?>
			<?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>

<?php ActiveForm::end() ?>