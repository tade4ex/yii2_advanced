<?php

namespace frontend\controllers;

use frontend\assets\HelloAsset;
use inpassor\realplexor\Realplexor;
use Yii;

class HelloController extends \yii\web\Controller
{
    public $rpl;
    /**
     * @return string
     */
    public function actionIndex()
    {
        HelloAsset::register($this->view);
        $this->rpl->send("Alpha", array("data" => "Была обновлена страница"));
        return $this->render('index');
    }

    public function actionSend()
    {
        $message = Yii::$app->request->post('message');
        return json_encode([
            'send' => $this->rpl->send("Alpha", ["data" => $message])
        ]);
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->rpl = new Realplexor();
        $this->rpl->host = "127.0.0.1";
        $this->rpl->port = 10010;
        return true;
    }

}
