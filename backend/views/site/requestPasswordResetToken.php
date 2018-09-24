<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Esqueci Minha Senha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">

    <p>Por favor, preencha seu email. Um link para redefinição de senha será enviado para o mesmo.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->label("<font color='#FF0000'>*</font> Email") ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-4 col-md-4">{image}</div><div class="col-lg-6 col-md-4">{input}</div></div>',
                ])->label("<font color='#FF0000'>*</font> Código de Verificação (Clique na imagem para trocar o código)") ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
