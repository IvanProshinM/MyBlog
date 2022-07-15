<?php

namespace app\models;

use app\modules\api\query\UserQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id;
 * @property string|null $phone;
 * @property string $first_name;
 * @property string|null $middle_name;
 * @property string $last_name;
 * @property string $gender;
 * @property int $birthday;
 * @property string $sms_code_confirm;
 * @property string $auth_key;
 * @property string $password_hash;
 * @property string $password_reset_token;
 * @property int $status_id;
 * @property int $created_at;
 * @property int $updated_at;
 * @property int $confirmed_at;
 * @property int $role_id;
 * @property string $firebase_token;
 * @property string $last_coordinate;
 *
 *
 */
class User extends ActiveRecord implements IdentityInterface
{


    public static function tableName()
    {
        return "user";
    }

    public function rules()
    {
        return [
            [['id', 'status_id', 'created_at', 'updated_at', 'confirmed_at', 'role_id',], 'integer'],
            [['phone', 'first_name', 'middle_name', 'last_name', 'gender', 'sms_code_confirm', 'auth_key', 'password_hash', 'password_reset_token', 'firebase_token',], 'string'],
            ['birthday', 'date', 'format' => 'Y-m-d'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];

    }

    public static function find()
    {
        return new UserQuery(static::class);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    public static function findIdentity($id)
    {
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getAge()
    {
        $currentYear = (integer) date('Y',time());
        $userBirthday = (integer) date('Y',strtotime($this->birthday));
        return ($currentYear-$userBirthday);
    }
}