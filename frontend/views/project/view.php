<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $userTaskContainers \app\models\TaskContainer */
/* @var $projectUserTasksByContainer \app\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Project') ?>: <?= Html::encode($this->title) ?></h3>
                <p><?= $model->description ?></p>
            </div>
            <div class="box-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Create container'), ['task-container/create', 'project_id' => $model->id], ['class' => 'btn btn-info']) ?>
                    <?= Html::a(Yii::t('app', 'Complete'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($userTaskContainers as $taskContainer) : $taskContainer = $taskContainer->toArray(); ?>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= $taskContainer['name'] ?></h3>
                        <p><?= $taskContainer['description'] ?></p>
                        <div class="box-tools pull-right">
                            <?= Html::a(Yii::t('app', 'Add task'), ['task/create', 'project_id' => $model->id, 'task_container_id' => $taskContainer['id']], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($projectUserTasksByContainer[$taskContainer['id']])) : ?>
                            <?php foreach ($projectUserTasksByContainer[$taskContainer['id']] as $task) : ?>
                                <div class="callout callout-info">
                                    <h4><?= $task['name']; ?></h4>
                                    <p><?= $task['description']; ?></p>
                                    <p>
                                        <i><?= Yii::t('app', 'from') ?> <?= $task['start']; ?></i>,<br> <?= Yii::t('app', 'to') ?>
                                        <i><?= $task['end']; ?></i></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>