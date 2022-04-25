<?php

namespace app\modules\admin\models;

use yii\base\Model;

class ChangeUser extends Model
{
    public int $id;
    public string $username;
    public string $nickname;
    public string $email;
    public string $password = '';
    public int $gender;
    public int $role;


    public function rules()
    {
        return [
            [['email'], 'email'],
            [['password'], 'string', 'min' => 4, 'max' => 16],
            [['username'], 'match', 'pattern' => '/^[А-яА-Я_ ]/'],
            [['username', 'nickname'], 'string', 'min' => 4, 'max' => 15],
            ['gender', 'in', 'range' => [0, 1]],
            ['role', 'in', 'range' => [0, 1, 2]]
        ];
    }


}