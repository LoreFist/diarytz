<?php

/* @var $user \app\modules\user\models\User */

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password', 'token' => $user->password_reset_token]);
?>

<div class="password-reset">
    <p>Привет, <?= Html::encode($user->username) ?>,</p>
    <p>Перейдите по ссылке чтобы востановить пароль:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>