<?php

namespace frontend\controllers;

use yii\web\Controller;

class PjaxDemoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['time' => date('H:i:s')]);
    }
}