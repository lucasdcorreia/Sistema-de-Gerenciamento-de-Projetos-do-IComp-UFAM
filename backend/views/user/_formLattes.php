<?php

use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use kartik\widgets\SwitchInput;

$uploadRealizados = 0;
$uploadXML = 0;

?>

<?php
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>
<div>
    <?php
    $form = ActiveForm::begin([
        'options' => [ 'enctype' => 'multipart/form-data']
    ]);
    ?>
    <?= $form->field($model, 'file')->fileInput(); ?>
    <?php if ($model->file_id): ?>
        <div class="form-group">
            <?= Html::img(['/file', 'id' => $model->file_id]) ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
