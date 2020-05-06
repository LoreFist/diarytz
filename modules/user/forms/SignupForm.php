<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;

class SignupForm extends Model {

    public $email;
    public $username;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        $symbols = '\-\_\~\!\@\#\$\&\(\)\+\?\=\/\|\\\.\,\;\:\<\>\[\]';
        $engSym = $symbols.'0-9a-z';
        $rusSym = $symbols.'0-9а-яё';
        return [
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass'     => User::class,
                'targetAttribute' => 'email',
                'message'         => 'Пользователь с таким Email уже существует!',
            ],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class],
            ['username', 'string', 'min' => 1, 'max' => 50],
            ['username', 'match', 'pattern' => "/(^[$engSym]([$engSym]+[\s]?)*[$engSym]$)|(^[$rusSym]([$rusSym]+[\s]?)*[$rusSym]$)/iu"],
            ['password', 'required'],
            ['password', 'string', 'min' => 5, 'max' => 50],
            ['password', 'match', 'pattern' => '/^([^\"\'\%\*\<\>][0-9a-zA-Z]+)$/iu'],
        ];
    }

    /**
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\Exception
     */
    public function signUp() {
        if ( !$this->validate()) return null;

        $user = new User();

        $user->username = $this->username;
        $user->email    = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}