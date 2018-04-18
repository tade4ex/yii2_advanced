<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $childProjects array */
/* @var $tasks array */

$this->title = Yii::t('app', 'Project') . ': ' . $model->name;
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

<?= Html::beginTag('div', ['class' => 'content project-view']) ?>
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?= Html::beginTag('div', ['class' => 'col-md-12 box']) ?>
    <!-- .box-header -->
<?= Html::beginTag('div', ['class' => 'box-header']) ?>
<?= Html::tag('h3', Yii::t('app', 'Project description') . ':', ['class' => 'box-title']) ?>
<?= Html::tag('p', $model->description, []) ?>
<?= Html::tag('p', Yii::t('app', 'Task count ({taskCount}), complete ({taskCompleteCount})', [
    'taskCount' => count($tasks),
    'taskCompleteCount' => 0,
]), []
) ?>
<?= Html::endTag('div') ?>
    <!-- // .box-header -->
    <!-- .box-body -->
<?= Html::beginTag('div', ['class' => 'box-body']) ?>
<?php if (!empty($model->parent_id)) : ?>
    <?= Html::a(Yii::t('app', 'View parent project'), ['view', 'id' => $model->parent_id], ['class' => 'btn btn-success']) ?>
<?php endif ?>
<?= Html::a(Yii::t('app', 'Create new task'), ['/task/create', 'id' => $model->id], ['class' => 'btn btn-primary index-modal-link']) ?>
<?= ' ' ?>
<?= Html::a(Yii::t('app', 'Update project'), ['update', 'id' => $model->id], ['class' => 'btn btn-success index-modal-link']) ?>
<?= ' ' ?>
<?= Html::a(Yii::t('app', 'Delete project'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger index-modal-link']) ?>
<?= Html::endTag('div') ?>
    <!-- // .box-body -->
    <!-- child projects -->
<?php if (!empty($childProjects)) : ?>
    <?= Html::beginTag('div', ['class' => 'panel-group', 'id' => 'accordion', 'role' => 'tablist', 'aria-multiselectable' => 'true']) ?>
    <?= Html::beginTag('div', ['class' => 'panel panel-default']) ?>
    <!-- .panel-heading -->
    <?= Html::beginTag('div', ['class' => 'panel-heading', 'role' => 'tab', 'id' => 'headingOne']) ?>
    <?= Html::tag('h4',
        Html::a(Yii::t('app', 'Child projects'), ['#collapseOne'], [
            'role' => 'button',
            'data-toggle' => 'collapse',
            'data-parent' => '#accordion',
            'aria-expanded' => 'true',
            'aria-controls' => 'collapseOne'
        ]), ['class' => 'panel-title']
    ) ?>
    <?= Html::endTag('div') ?>
    <!-- // .panel-heading -->
    <!-- .panel-collapse -->
    <?= Html::beginTag('div', ['id' => 'collapseOne', 'class' => 'panel-collapse collapse', 'role' => 'tabpanel', 'aria-labelledby' => 'headingOne']) ?>
    <?= Html::beginTag('div', ['class' => 'panel-body']) ?>
    <?= Html::beginTag('div', ['class' => 'row']) ?>
    <?php foreach ($childProjects as $project) : /* @var $project \app\models\Project */ ?>
        <?= Html::beginTag('div', ['class' => 'col-md-3']) ?>
        <?= Html::beginTag('div', ['class' => 'box box-success']) ?>
        <?= Html::beginTag('div', ['class' => 'box-header with-borde']) ?>
        <?= Html::tag('h3', $project->name, ['class' => 'box-title']) ?>
        <?= Html::tag('div',
            Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project->id], ['class' => 'btn-sm btn-primary'])
            , ['class' => 'box-tools pull-right']
        ) ?>
        <?= Html::endTag('div') ?>
        <?= Html::beginTag('div', ['class' => 'box-body']) ?>
        <?php if (!empty($project->description)) : ?>
            <?= Html::tag('p', $project->description, []) ?>
        <?php endif; ?>
        <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
    <?php endforeach; ?>
    <?= Html::endTag('div') ?>
    <?= Html::endTag('div') ?>
    <?= Html::endTag('div') ?>
    <!-- // .panel-collapse -->
    <?= Html::endTag('div') ?>
    <?= Html::endTag('div') ?>
<?php endif ?>
    <!-- // child projects -->
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?php if (!empty($tasks)) : ?>
    <?= Html::beginTag('div', ['class' => 'row']) ?>
    <?php foreach ($tasks as $task) : /* @var $task \app\models\Task */ ?>
        <?= Html::beginTag('div', ['class' => 'col-md-4']) ?>
        <?= Html::beginTag('div', ['class' => 'box box-primary']) ?>
        <?= Html::beginTag('div', ['class' => 'box-header']) ?>
        <?= Html::tag('h3', ' ', []) ?>
        <?= Html::beginTag('div', ['class' => 'box-tools pull-right']) ?>
        <?= Html::a(Yii::t('app', 'Complete task'), ['/task/complete', 'id' => $task->id], ['class' => 'btn-sm btn-primary index-modal-link']) ?>
        <?= Html::a(Yii::t('app', 'Update task'), ['/task/update', 'id' => $task->id], ['class' => 'btn-sm btn-success index-modal-link']) ?>
        <?= Html::a(Yii::t('app', 'Delete task'), ['/task/delete', 'id' => $task->id], ['class' => 'btn-sm btn-danger index-modal-link']) ?>
        <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
        <?= Html::beginTag('div', ['class' => 'box-body']) ?>
        <?= Html::tag('h4', $task->name, []) ?>
        <?= Html::tag('p', $task->description, []) ?>
        <?= Html::beginTag('p', []) ?>
        <?= Html::tag('i',
            Yii::t('app', 'from') . ','
            . $task->start
            , []) ?>
        <br>
        <?= Html::tag('i',
            Yii::t('app', 'to') . '<br>'
            . $task->end
            , []) ?>
        <?= Html::endTag('p') ?>
        <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
        <?= Html::endTag('div') ?>
    <?php endforeach ?>
    <?= Html::endTag('div') ?>
<?php endif ?>
<?= Html::endTag('div') ?>