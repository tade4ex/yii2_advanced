<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class PjaxDemoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/pjax-demo.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}