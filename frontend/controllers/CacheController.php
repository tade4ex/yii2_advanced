<?php

namespace frontend\controllers;

use common\components\AccessRule;
use Yii;
use yii\caching\Cache;
use yii\caching\DummyCache;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\User;

/**
 * Calendar controller
 */
class CacheController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'clear-schema',],
                'rules' => [
                    [
                        'actions' => ['index', 'clear-schema',],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    public function actionClearSchema()
    {
        Yii::$app->schema_cache->flush();
        return $this->render('index', [
            'alertSuccess' => 'Schema cache clear success'
        ]);
    }

}