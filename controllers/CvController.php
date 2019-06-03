<?php

namespace app\controllers;

use app\models\CvLoadForm;
use yii\filters\AccessControl;
use app\models\Cv;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class CvController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {

        $file = new CvLoadForm();


        if ($file->load(Yii::$app->request->post())) {
            if ($file->validate()){
                $file->file = UploadedFile::getInstance($file, 'file');
                if ($file->upload()){
                    return $this->redirect(['index']);
                }

            }

        }

        return $this->render('add', [
            'file' => $file
        ]);
    }
}
