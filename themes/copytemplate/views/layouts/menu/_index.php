<?php

use app\themes\copytemplate\components\Helper;
use yii\widgets\Menu;

if (Yii::$app->user->isGuest) {
    $items[] = [
        'label'    => Yii::t('app', 'Вход'),
        'url'      => ['/user/default/login'],
        'template' => Helper::getTemplateMenu('lock')
    ];
    $items[] = [
        'label'    => Yii::t('app', 'Регистрация'),
        'url'      => ['/user/default/registration'],
        'template' => Helper::getTemplateMenu('new-user')
    ];
} else {
    $items[] = ['label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')', 'url' => ['/user/default/logout']];
}

echo Menu::widget([
    'options' => ['class' => 'nav navbar-nav navbar-index'],
    'items'   => $items,
]);
