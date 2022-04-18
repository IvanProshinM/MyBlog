<?php

namespace app\models;

use yii\base\Model;

class Registration extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $password;
    public $confirmPassword;
    public $gender;
    public $activateHash;
    public $activatedAt;


    public function rules()
    {
        return [
            [['username', 'nickname', 'email', 'password', 'confirmPassword', 'gender'], 'required'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 4, 'max' => 16],
            [['confirmPassword'], 'confirmPassword'],
            [['username'], 'match', 'pattern' => '/^[А-яА-Я_ ]/'],
            [['username', 'nickname'], 'string', 'min' => 4, 'max' => 15],
            ['gender', 'in', 'range' => [0, 1]]
        ];
    }

    public function confirmPassword($attribute)
    {
        if ($this->password !== $this->$attribute) {
            $this->addError($attribute, 'Введенные пароли не совпадают');
        }
    }

}

