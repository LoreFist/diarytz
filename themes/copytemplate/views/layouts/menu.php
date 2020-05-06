<?php

use yii\bootstrap\Html;
use yii\bootstrap\NavBar;

$headerLogoFull = Html::a(Html::tag('span',null,['class'=>'i-logo-full','alt'=>'Diary.ru', 'title'=>'Главная']),'/',['class'=>'navbar-brand visible-lg']);

NavBar::begin([
    'options'       => [
        'class' => 'navbar navbar-inverse',
    ],
    'headerContent' => $headerLogoFull
]);

echo $this->render('menu/_more');
echo $this->render('menu/_index');
echo $this->render('menu/_more_right');

NavBar::end();