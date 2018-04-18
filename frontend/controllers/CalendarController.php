<?php

namespace frontend\controllers;

use app\models\Task;
use yii\web\Controller;
use yii2fullcalendar\models\Event;


/**
 * Calendar controller
 */
class CalendarController extends Controller
{

    /**
     * @param $start
     * @param $end
     * @return string
     */
    public function actionGetEvents($start, $end)
    {
        $start = date('Y-m-d H:i:s', $start);
        $end = date('Y-m-d H:i:s', $end - 1);
        $tasks = Task::find()->getByStartEnd($start, $end)->all();
        $events = [];
        foreach ($tasks as $task) {
            $event = new Event();
            $event->id = $task->id;
            $event->title = $task->name;
            $event->start = date('Y-m-d\TH:i:s\Z', strtotime($task->start));
            $event->end = date('Y-m-d\TH:i:s\Z', strtotime($task->end));
            if ($task->complete) {
                $event->color = '#00a65a';
                $event->className = 'task-complete';
            }
            $events[] = $event;
        }
        return json_encode($events);
    }

}