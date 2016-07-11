<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ResetPasswordForm;


class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['changeprofile','resetpassword'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }    

    public function actionChangeprofile()
    {
        return $this->render('changeprofile');
    }    

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionResetpassword()
    {
        /* @var $userModel UserModel */
        $userModel = Yii::$app->user->identity;
        $resetPasswordForm = new ResetPasswordForm($userModel);

        if ($resetPasswordForm->load(Yii::$app->request->post()) && $resetPasswordForm->resetPassword()) {
            Yii::$app->session->setFlash('resetpassword-success', 'Senha alterada com sucesso!');
            return $this->redirect(['resetpassword']);
        }

        return $this->render('resetpassword', [
            'resetPasswordForm' => $resetPasswordForm,
            'userModel' => $userModel
        ]);
    }    
}