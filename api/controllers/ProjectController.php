<?php

namespace api\controllers;

use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends ActiveController
{
    public $modelClass = 'app\models\Project';

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

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
        ];
        return $actions;
    }
}
