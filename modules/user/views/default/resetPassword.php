<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title                   = 'Установка нового пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста введите новый пароль:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>