<?php

/* @var $this yii\web\View */
/* @var $projects array */

/* @var $last5tasks array */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;

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

<?= Html::beginTag('div', ['class' => 'content']) ?>
<!-- header -->
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?= Html::beginTag('div', ['class' => 'col-md-12']) ?>
<?= Html::tag('p',
    Html::a(Yii::t('app', 'Create project'), ['/project/create'], ['class' => 'btn btn-success index-modal-link'])
    , []
) ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<!-- projects -->
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?php foreach ($projects as $project) : ?>
    <?= $this->render('//project/_view_project', [
        'project' => $project
    ]) ?>
<?php endforeach; ?>
<?= Html::endTag('div') ?>
<?php if (count($last5tasks) > 0) : ?>
    <?= Html::beginTag('div', ['class' => 'row']) ?>
    <?= Html::beginTag('div', ['class' => 'col-md-12']) ?>
    <?= Html::tag('h3', Yii::t('app', 'Last watch tasks'), []) ?>
    <?= Html::endTag('div') ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'row']) ?>
    <?php foreach ($last5tasks as $task) : ?>
        <?= $this->render('//task/_view_task', [
            'task' => $task
        ]) ?>
    <?php endforeach; ?>
    <?= Html::endTag('div') ?>
<?php endif ?>
<?= Html::endTag('div') ?>