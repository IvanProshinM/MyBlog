<?php

namespace app\models;

use app\query\UserQuery;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $nickname
 * @property string|null $email
 * @property string|null $password
 * @property int|null $gender
 * @property string|null $resetHash
 * @property string|null $activateHash
 * @property string|null $activatedAt
 * @property int $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public CONST ROLE_READER = 0;
    public CONST ROLE_REDACTOR = 1;
    public CONST ROLE_ADMIN = 2;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = \Yii::$app->security->generatePasswordHash($password);
    }

    public function isAdmin()
    {
        return $this->nickname === "Gerdvi";
    }

    public static function find()
    {
        return new UserQuery(static::class);
    }

}
