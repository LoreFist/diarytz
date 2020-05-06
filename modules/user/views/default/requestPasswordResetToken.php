<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title                   = 'Востановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста введите емайл для востановаления пароля</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>