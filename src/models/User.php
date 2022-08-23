<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Boolean;
use yii\db\ActiveRecord;
use Yii;


/**
 * @property string $userName;
 * @property string $login;
 * @property string $password;
 * @property boolean|null $isActive;
 *
 */




class User extends ActiveRecord
{

    public static function tableName()
    {
       return "user";
    }

    public function rules() {
        return [
            [["userName", "login", "password"], "string"],
            [["isActive"], "boolean"],
        ];
    }


}