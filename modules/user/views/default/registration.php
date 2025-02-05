<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title                   = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните поля для регистрации:</p>

    <?php $form = ActiveForm::begin([
        'id'          => 'login-form',
        'layout'      => 'horizontal',
        'fieldConfig' => [
            'template'     => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>