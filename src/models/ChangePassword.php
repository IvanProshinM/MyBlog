<?php

namespace app\models;

use yii\base\Model;

class ChangePassword extends Model
{

    public $password;
    public $confirmPassword;

    public function rules() {
        return [
            [['password', 'confirmPassword'], 'required' ],
            [['password'], 'string','min' =>6 , 'max'=> 15],
            [['confirmPassword'], 'confirmPassword' ],

        ];
    }

    public function confirmPassword($attribute) {
        if (($this->password !== $this->$attribute)) {
            $this->addError($attribute, 'Введенные пароли не совпадают');
        }
    }


}
