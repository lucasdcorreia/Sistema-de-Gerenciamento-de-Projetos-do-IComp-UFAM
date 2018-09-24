<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Olá <?= Html::encode($user->nome) ?>,</p>

    <p>Você solicitou a recuperação da sua senha. Segue o link abaixo para definição de uma nova senha:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
