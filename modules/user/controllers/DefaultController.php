<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\LoginForm;
use app\modules\user\forms\PasswordResetRequestForm;
use app\modules\user\forms\ResetPasswordForm;
use app\modules\user\forms\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class DefaultController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['login', 'logout', 'registration', 'requestPasswordReset', 'resetPassword'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['login', 'registration', 'requestPasswordReset', 'resetPassword'],
                        'roles'   => ['?'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['logout'],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin() {
        if ( !Yii::$app->user->isGuest) return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) AND $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistration() {
        if ( !Yii::$app->user->isGuest) return $this->goHome();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $user = $model->signUp()) {
            Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались.');
            Yii::$app->getUser()->login($user);
            return $this->goHome();
        }

        return $this->render('registration', ['model' => $model]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свой почтовый ящик и следуйте инструкциям.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Извините, во время востановления пароля произошла ошибка. Обратитесь в служжбу поддержки');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль был сохранен');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}