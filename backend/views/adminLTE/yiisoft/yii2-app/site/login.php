<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

echo Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php');
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b> PPGI </b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"> Entre com seu Login e Senha</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label("CPF")
            ->widget(MaskedInput::className(), [
            'mask' => '999.999.999-99']) ?>  

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label("Senha")
            ->passwordInput() ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-12" style="margin-bottom: 12px;">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <p><?= Html::a('Eu Esqueci minha senha', ['site/request-password-reset'])?></p>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
