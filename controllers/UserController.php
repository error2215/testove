<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->mailer->compose()
                ->setFrom('testove@gmail.com')
                ->setTo($model->email)
                ->setSubject('Registration on testove')
                ->setTextBody("Registration was successful!\n username: " .  $model->username. "; email: " . $model->email . '; password: ' . $model->password)
                ->setHtmlBody('<b>' . "Registration was successful! <br> username: " .  $model->username. "; email: " . $model->email . '; password: ' . $model->password .  '</b>')
                ->send();

            return $this->goBack();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
