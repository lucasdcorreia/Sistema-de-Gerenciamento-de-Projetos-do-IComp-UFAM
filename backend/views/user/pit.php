<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Periodo;

$this->title = 'Upload Currículo Lattes';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>Selecione o ano/semestre do PIT a ser baixado:</b></h3>
		</div>
		<div class="panel-body">
			<?= Html::activeDropDownList($model, 's_id', Periodo::map(Standard::find()->all(), 's_id', 'name')) ?>
			<?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>

<?php ActiveForm::end() ?>