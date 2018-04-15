<?php

namespace api\controllers;

use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends ActiveController
{

    public $modelClass = 'app\models\Task';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        $behaviors['authenticator']['auth'] = function ($username, $password) {
            $user = User::findOne(['username' => $username]);
            if ($user->validatePassword($password)) {
                return $user;
            }
            return null;
        };
        return $behaviors;
    }
}
