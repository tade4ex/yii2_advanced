<?php

namespace common\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class BaseLastTask
{
    public static $saveLast = 5;

    public static function getLast5Url()
    {
        $last5Urls = [];
        for ($i = 0; $i <= self::$saveLast; $i++) {
            $previous = Url::previous('task-' . $i);
            if (!empty($previous)) {
                $last5Urls[] = $previous;
            }
        }
        return $last5Urls;
    }

    public static function getIds()
    {
        $last5Urls = self::getLast5Url();
        $ids = [];
        foreach ($last5Urls as $url) {
            if (!empty($url)) {
                $matches = array();
                preg_match('/\?id=([0-9]+)/', $url, $matches);
                $id = $matches[1];
                $ids[] = $id;
            }
        }
        return $ids;
    }

    public static function saveUrl()
    {
        $last5Urls = self::getLast5Url();
        $current = Url::current();
        if (ArrayHelper::isIn($current, $last5Urls)) {
            ArrayHelper::removeValue($last5Urls, $current);
        }
        array_unshift($last5Urls, $current);
        for ($i = 0; $i <= self::$saveLast; $i++) {
            if (!empty($last5Urls[$i])) {
                Url::remember($last5Urls[$i], 'task-' . $i);
            } else {
                Url::remember(null, 'task-' . $i);
            }
        }
    }

}