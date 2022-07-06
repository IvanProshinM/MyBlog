<?php

namespace app\modules\api\controllers;

use app\models\User;
use app\modules\api\models\CoordinateModel;
use app\modules\api\models\FireBaseToken;
use yii\db\Expression;
use yii\filters\auth\HttpBearerAuth;
use app\modules\api\models\ConfirmModel;
use app\modules\api\models\SignModel;
use app\modules\api\services\ConfirmUserService;
use app\modules\api\services\CreateUserService;
use yii\helpers\VarDumper;
use yii\rest\Controller;
use Yii;

class  UserController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['update'];
        return $behaviors;
    }


    /**
     * @var CreateUserService
     */

    /**
     * @var ConfirmUserService
     */


    private $createUserService;

    private $confirmUserService;

    public function __construct($id,
        $module,
                                CreateUserService $createUserService,
                                ConfirmUserService $confirmUserService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createUserService = $createUserService;
        $this->confirmUserService = $confirmUserService;
    }


    public function actionSignIn()
    {

        $model = new SignModel();
        $data = Yii::$app->request->getBodyParams();
        $model->load($data);
        $user = $this->createUserService->CreateUser($model);
        if ($user == null) {
            echo 'GENA NA';
        }
        return [
            'is_exist_user' => $user->confirmed_at !== null,
        ];

    }

    public function actionConfirm()
    {
        $model = new ConfirmModel();
        $data = Yii::$app->request->getBodyParams();
        $model->load($data);
        if (!$model->validate()) {
            throw new \Exception('не прошла валидация формы');
        }
        $user = $this->confirmUserService->ConfirmUser($model);
        if (!$user->validate()) {
            return null;
        }
        if ($user === null) {
            return [
                'sms_code_confirm' => null
            ];
        }

        return [
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "middle_name" => $user->middle_name,
            "gender" => $user->gender,
            "birthday" => $user->birthday,
            "auth_key" => $user->auth_key,
            "role" => "admin, patient, doctor"
        ];

    }

    public function actionProfile()
    {
        $headers = Yii::$app->request->headers;
        $authorization = $headers->get('Authorization');
        $auth_token = explode(" ", $authorization);
        $user = User::find()->where(['auth_key' => $auth_token[1]])->one();
        if (!$user) {
            throw new \Exception('Ошибка Авторизации');
        }
        if (!$user->validate()) {
            return null;
        }
        return [
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "middle_name" => $user->middle_name,
            "gender" => $user->gender,
            "birthday" => $user->birthday,
            "is_ill" => true,
            "role" => "admin, patient, doctor",
            "doctor" => [
                "first_name" => "Иван",
                "last_name" => "Пупкин",
                "middle_name" => "Васильевич",
                "phone" => "+79012345678"
            ]];
    }

    public function actionFirebase()
    {
        $model = new FireBaseToken();
        $data = Yii::$app->request->getBodyParams();
        $model->load($data);
        if (!$model->validate()) {
            return null;
        }
        $user = Yii::$app->user->identity;
        $user->firebase_token = $model->firebase_token;
        $user->save();
        return [
            'firebase_token' => 'string'
        ];
    }

    public function actionCoordinate()
    {
        $model = new CoordinateModel();
        $data = Yii::$app->request->getBodyParams();
        $model->load($data);

        if (!$model->validate()) {
            return null;
        }
        $user = Yii::$app->user->identity;

        $params = [
            ':latitude' => $model->latitude,
            ':longitude' => $model->longitude,
            ':user_id' => $user->id
        ];

        $sql = new Expression("UPDATE `user` SET `last_coordinate`=POINT(:latitude, :longitude) WHERE `id` = :user_id");

        Yii::$app->db->createCommand($sql, $params)->execute();
        return true;
    }


}