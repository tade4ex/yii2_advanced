<?php

namespace console\controllers;

use console\components\TelegramSendNotify;
use console\components\TelegramSubscribe;
use yii\console\Controller;

class TelegramController extends Controller
{
    public function actionIndex()
    {
        $subscribe = new TelegramSubscribe();
        $subscribe->run();
    }

    public function actionSendMessage()
    {
        $notify = new TelegramSendNotify();
        $notify->sendOne();
    }
}