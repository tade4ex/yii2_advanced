<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/jquery-realplexor.js',
        'js/chat.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
//        'inpassor\assets\JqueryCommon',
    ];
}