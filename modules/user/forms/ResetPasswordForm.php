<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

class ResetPasswordForm extends Model {

    public $password;

    /**
     * @var User
     */
    private $_user;

    /**
     * @param string $token
     * @param array  $config name-value pairs that will be used to initialize the object properties
     *
     * @throws InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = []) {

        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }

        $this->_user = User::findByPasswordResetToken($token);

        if ( !$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @return bool if password was reset.
     * @throws \yii\base\Exception
     */
    public function resetPassword() {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}