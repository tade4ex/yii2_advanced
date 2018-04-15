<?php

namespace api\controllers;

use yii\rest\ActiveController;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends ActiveController
{
    public $modelClass = 'app\models\Project';
}
