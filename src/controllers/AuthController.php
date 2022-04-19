<?php

namespace app\controllers;

use app\models\Authorization;
use app\models\ChangePassword;
use app\models\Recover;
use app\models\Registration;
use app\services\UserAuthorizationService;
use app\services\UserCreateService;
use app\services\UserFindEmailService;
use app\services\UserRecoverPasswordService;
use app\services\UserRegistrationNotification;
use yii\web\Controller;
use yii\web\Session;
use Yii;

class AuthController extends Controller
{

    /**
     * @var UserCreateService
     */
    private $userCreateService;

    /**
     * @var UserFindEmailService;
     */
    private $userFindEmailService;

    /**
     * @var UserRegistrationNotification;
     */
    private $userRegistrationNotification;

    /**
     * @var UserAuthorizationService;
     */
    private $userAuthorizationService;

    /**
     * @var UserRecoverPasswordService;
     */
    private $userRecoverPasswordService;


    public function __construct(
        $id,
        $module,
        UserCreateService $userCreateService,
        UserFindEmailService $userFindEmailService,
        UserRegistrationNotification $userRegistrationNotification,
        UserAuthorizationService $userAuthorizationService,
        UserRecoverPasswordService $userRecoverPasswordService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userCreateService = $userCreateService;
        $this->userFindEmailService = $userFindEmailService;
        $this->userRegistrationNotification = $userRegistrationNotification;
        $this->userAuthorizationService = $userAuthorizationService;
        $this->userRecoverPasswordService = $userRecoverPasswordService;
    }

    public function actionRegistration()
    {
        $model = new Registration();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $userNew = $this->userFindEmailService->findMail($model);
            if ($userNew) {
                $session->setFlash('error', 'Пользователь с такой почтой существует! Попробуйте другую');
                return $this->render('registration', ['model' => $model]);
            } else {
                $user = $this->userCreateService->create($model);
                $user->save();
                $this->userRegistrationNotification->send($user);
                $session->setFlash('success', 'Пользователь успешно зарегистрирован! На Вашу почту выслана ссылка для подтверждения');
                $model = new Registration();
                return $this->render('registration', ['model' => $model]);
            }
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionAuthorization()
    {
        $model = new Authorization();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = $this->userAuthorizationService->authorizate($model);
            if ($user != null) {
                \Yii::$app->user->login($user, 3600);
                $session->setFlash('success', 'Вы успешно авторизовались');
                return $this->redirect(['site/index']);
            }
            $session->setFlash('error', 'Пользователь с таким email отсутствует');
            return $this->render('authorization', ['model' => $model]);
        }
        return $this->render('authorization', ['model' => $model]);
    }

    public function actionRecover()
    {
        $model = new Recover();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $resetPassword = $this->userRecoverPasswordService->reset($model);
            if ($resetPassword) {
                $session->setFlash('success', 'Ссылка для сброса пароля отправлена на почту');
                return $this->redirect(['auth/authorization']);
            }
            $session->setFlash('error', 'Пользователь с такой почтой не найден');
            return $this->render('recover', ['model' => $model]);
        }
        return $this->render('recover', ['model' => $model]);
    }

    public function actionChangePassword($resetHash)
    {
        $model = new ChangePassword();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = $this->userRecoverPasswordService->changePassword($model, $resetHash);
            $user->save();
            $session->setFlash('success', 'Пароль успешно изменён.');
            return $this->redirect(['auth/authorization']);

        }
        else {
            return $this->render('changePassword', ['model' => $model]);
        }

    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        $session->setFlash('success', 'Вы успешно разлогинились.');
        return $this->redirect(['auth/authorization']);
    }



}