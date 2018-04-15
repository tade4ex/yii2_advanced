<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $childProjects array */
/* @var $tasks array */

$this->title = Yii::t('app', 'Project') . ': '. $model->name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
$(document).ready(function() {
    $(document).on('click', '.index-modal-link', function () {
        $('#index-modal').modal({ show: true });
    });
});
");
?>

<?php Modal::begin([
    'id' => 'index-modal',
]) ?>
<?php Pjax::begin([
    'id' => 'pjax-modal-container',
    'linkSelector' => '.index-modal-link',
    'enablePushState' => false,
]) ?>
<?php Pjax::end() ?>
<?php Modal::end() ?>

<div class="content project-view">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Project description') ?>:</h3>
                <p><?= $model->description ?></p>
                <p><?= Yii::t('app', 'Task count ({taskCount}), complete ({taskCompleteCount})', [
                        'taskCount' => count($tasks),
                        'taskCompleteCount' => 0,
                    ]) ?></p>
            </div>
            <div class="box-body">
                <?php if (!empty($model->parent_id)) : ?>
                    <?= Html::a(Yii::t('app', 'View parent project'), ['view', 'id' => $model->parent_id], ['class' => 'btn btn-success']) ?>
                <?php endif ?>
                <?= Html::a(Yii::t('app', 'Create new task'), ['/task/create', 'id' => $model->id], ['class' => 'btn btn-primary index-modal-link']) ?>
                <?= Html::a(Yii::t('app', 'Update project'), ['update', 'id' => $model->id], ['class' => 'btn btn-success index-modal-link']) ?>
                <?= Html::a(Yii::t('app', 'Delete project'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger index-modal-link']) ?>
            </div>
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
                                    <?php foreach ($childProjects as $project) : /* @var $project \app\models\Project */ ?>
                                        <div class="col-md-3">
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><?= $project->name ?></h3>
                                                    <div class="box-tools pull-right">
                                                        <?= Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project->id], ['class' => 'btn-sm btn-primary']) ?>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <?php if (!empty($project->description)) : ?>
                                                        <p><?= $project->description ?></p>
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
    <?php if (!empty($tasks)) : ?>
        <div class="row">
            <?php foreach ($tasks as $task) : /* @var $task \app\models\Task */ ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3> </h3>
                            <div class="box-tools pull-right">
                                <?= Html::a(Yii::t('app', 'Update task'), ['/task/update', 'id' => $task->id], ['class' => 'btn-sm btn-success index-modal-link']) ?>
                                <?= Html::a(Yii::t('app', 'Delete task'), ['/task/delete', 'id' => $task->id], ['class' => 'btn-sm btn-danger index-modal-link']) ?>
                            </div>
                        </div>
                        <div class="box-body">
                            <h4><?= $task->name ?></h4>
                            <p><?= $task->description ?></p>
                            <p>
                                <i><?= Yii::t('app', 'from') ?> <?= $task->start; ?></i>,<br> <?= Yii::t('app', 'to') ?>
                                <i><?= $task->end; ?></i>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>
