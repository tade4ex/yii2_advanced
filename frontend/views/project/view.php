<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $parentProject app\models\Project */
/* @var $childProjects app\models\Project */
/* @var $userTaskContainers \app\models\TaskContainer */
/* @var $projectUserTasksByContainer \app\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$js = <<<EOF
var modals = ['#update-project-modal', '#create-container-modal', '#update-container-modal', '#create-task-modal'];
var modalFind = false;
modals.forEach(function (modalId) {
    var modal = $(modalId);
    if (modal.hasClass('modal')) {
        modalFind = true;
        modal.find('.modal-header').children('button').remove();
        modal.modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
});
if (!modalFind) { $('.modal-backdrop').hide(); }
else { $('.modal-backdrop').show(); }
EOF;

?>
<div class="content">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Project') ?>: <?= Html::encode($this->title) ?></h3>
                <p><?= $model->description ?></p>
                <p><?= Yii::t('app', 'Task count ({taskCount}), complete ({taskCompleteCount})', [
                    'taskCount' => $taskCount,
                    'taskCompleteCount' => $taskCompleteCount,
                ]) ?></p>
            </div>
            <div class="box-body">
                <?php Pjax::begin() ?>
                <p>
                    <?= (!empty($parentProject) ?
                        Html::a(Yii::t('app', 'Parent project'), ['view', 'id' => $parentProject->getAttribute('id')], ['class' => 'btn btn-success', 'data-pjax' => 0])
                        : '') ?>
                    <?= Html::a(Yii::t('app', 'Create container'), ['view', 'create-container-modal' => '', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                    <?php // Html::a(Yii::t('app', 'Complete'), [], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Update'), ['view', 'update-project-modal' => '', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= $updateProjectModal ?>
                    <?= $createContainerModal ?>
                    <?php $this->registerJs($js) ?>
                </p>
                <?php Pjax::end() ?>
                <?php if (!empty($childProjects)) : ?>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true" aria-controls="collapseOne">
                                        <?= Yii::t('app', 'Child projects') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row">
                                        <?php foreach ($childProjects as $project) : $project = $project->toArray(); ?>
                                            <div class="col-md-3">
                                                <div class="box box-success">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><?= $project['name'] ?></h3>
                                                        <div class="box-tools pull-right">
                                                            <?= Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project['id']], ['class' => 'btn-sm btn-primary']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <?php if (!empty($project['description'])) : ?>
                                                            <p><?= $project['description'] ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($userTaskContainers as $taskContainer) : $taskContainer = $taskContainer->toArray(); ?>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= $taskContainer['name'] ?></h3>
                        <p><?= $taskContainer['description'] ?></p>
                        <div class="box-tools pull-right">
                            <?php Pjax::begin() ?>
                                <?= Html::a(Yii::t('app', 'Update'), ['view', 'update-container-modal' => '', 'id' => $model->id, 'task_container_id' => $taskContainer['id']], ['class' => 'btn btn-info']) ?>
                                <?= Html::a(Yii::t('app', 'Add task'), ['view', 'create-task-modal' => '', 'id' => $model->id, 'task_container_id' => $taskContainer['id']], ['class' => 'btn btn-success']) ?>
                                <?= $updateContainerModal ?>
                                <?= $createTaskModal ?>
                                <?php $this->registerJs($js) ?>
                            <?php Pjax::end() ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($projectUserTasksByContainer[$taskContainer['id']])) : ?>
                            <?php foreach ($projectUserTasksByContainer[$taskContainer['id']] as $task) : ?>
                                <div class="callout callout-<?= ($task->complete ? 'success' : 'info') ?>">
                                    <h4><?= $task->name ?></h4>
                                    <p><?= $task->description ?></p>
                                    <?php if (!$task->complete) : ?>
                                    <p>
                                        <?= Html::a(Yii::t('app', 'complete task'), ['//task/complete', 'id' => $task->id, 'project_id' => $task->project_id], ['class' => 'btn-sm btn-success']) ?>
                                    </p>
                                    <?php endif ?>
                                    <p>
                                        <i><?= Yii::t('app', 'from') ?> <?= $task->start; ?></i>,<br> <?= Yii::t('app', 'to') ?>
                                        <i><?= $task->end; ?></i>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>