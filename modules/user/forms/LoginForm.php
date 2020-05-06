<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * @property User|null $user This property is read-only.
 */
class LoginForm extends Model {
    public  $email;
    public  $password;
    public  $rememberMe = true;
    private $_user      = false;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param $attribute
     */
    public function validatePassword($attribute) {
        if ( !$this->hasErrors()) {
            $user = $this->getUser();

            if ( !$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }

        }
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

}