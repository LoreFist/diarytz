<?php

namespace app\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int         $id
 * @property string      $username
 * @property string      $auth_key
 * @property string      $password_hash
 * @property string|null $password_reset_token
 * @property string      $email
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id'                   => 'ID',
            'username'             => 'Username',
            'auth_key'             => 'Auth Key',
            'password_hash'        => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email'                => 'Email',
            'created_at'           => 'Created At',
            'updated_at'           => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $password
     *
     * @throws \yii\base\Exception
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) return false;

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire    = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByPasswordResetToken($token) {

        if ( !static::isPasswordResetTokenValid($token)) return null;

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
}
