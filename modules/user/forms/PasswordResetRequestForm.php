<?php

namespace app\modules\user\forms;

use app\modules\user\jobs\MailerJob;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\queue\Queue;

class PasswordResetRequestForm extends Model {
    public $email;

    /** @var Queue */
    private $queue;
    /** @var MailerInterface */
    private $mailer;

    public function __construct($config = []) {
        $this->queue  = Instance::ensure('queue', Queue::class);
        $this->mailer = Instance::ensure('mailer', MailerInterface::class);

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => '\app\modules\user\models\User',
                'message'     => 'Пользователь с таким емайлом не найден'
            ],
        ];
    }

    /**
     * @return bool whether the email was send
     * @throws \yii\base\InvalidConfigException
     */
    public function sendEmail() {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if ( !$user) return false;

        if ( !User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if ( !$user->save()) {
                return false;
            }
        }

        $message = $this->mailer->compose(
            ['html' => '@modules/user/mails/passwordResetToken'],
            ['user' => $user]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($user->email)
            ->setSubject('Восстановление пароля');

        $job = Yii::createObject([
            'class'   => MailerJob::class,
            'message' => $message,
        ]);

        return $this->queue->push($job) ? true : false;
    }

}