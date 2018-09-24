<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Upload Currículo Lattes';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>Currículo Lattes</b></h3>
		</div>
		
		<div class="panel-body">
			<?php if ($user->administrador || $user->coordenador || $user->secretaria) {
				echo $form->field($model, 'professor_id', ['options' => ['class' => 'col-md-8']])->dropDownList($professores)->label('Selecione o professor desejado:');
			}
			?>
			<?= $form->field($model, 'lattesFile', ['options' => ['class' => 'col-md-7']])->fileInput(['accept' => '.xml'])->label("<div><b>Curriculum Lattes em XML:</b></div>") ?>
			<div class="col-md-1">
				<?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>			
			</div>
		</div>
	</div>

<?php ActiveForm::end() ?>