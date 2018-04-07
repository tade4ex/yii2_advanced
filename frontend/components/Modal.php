<?php

namespace frontend\components;

use Yii;
use yii\web\View;

class Modal {
    /**
     * @param $name
     * @param $viewName
     * @param $options
     * @return string
     */
    public static function renderModal($name, $viewName, $options)
    {
        $view = new View();
        $isModal = Yii::$app->request->get($name);
        return (isset($isModal)) ? $view->render($viewName, $options) : '';
    }
}