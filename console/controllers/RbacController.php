<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем роль "user"
        $student = $auth->createRole('student');
        $auth->add($student);

        // добавляем роль "user"
        $rd = $auth->createRole('rd');
        $auth->add($rd);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->assign($admin, 1);
    }

}