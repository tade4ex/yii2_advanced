<?php

/* @var $task \app\models\Task */

use yii\helpers\Html;

?>
<?= Html::beginTag('div', ['class' => 'col-md-4']) ?>
<?= Html::beginTag('div', ['class' => 'box box-' . ($task->complete ? 'success' : 'primary')]) ?>

<?= Html::beginTag('div', ['class' => 'box-header']) ?>
<?php if (!$task->complete) : ?>
    <?= Html::tag('h3', ' ', []) ?>
    <?= Html::beginTag('div', ['class' => 'box-tools pull-right']) ?>
    <?= Html::a(Yii::t('app', 'Complete task'), ['/task/complete', 'id' => $task->id], ['class' => 'btn-sm btn-primary index-modal-link']) ?>
    <?= ' ' ?>
    <?= Html::a(Yii::t('app', 'Update task'), ['/task/update', 'id' => $task->id], ['class' => 'btn-sm btn-success index-modal-link']) ?>
    <?= ' ' ?>
    <?= Html::a(Yii::t('app', 'Delete task'), ['/task/delete', 'id' => $task->id], ['class' => 'btn-sm btn-danger index-modal-link']) ?>
    <?= Html::endTag('div') ?>
<?php else : ?>
    <?= Html::tag('h3', Yii::t('app', ' '), []) ?>
    <?= Html::beginTag('div', ['class' => 'box-tools pull-right']) ?>
    <?= Html::a(Yii::t('app', 'Delete task'), ['/task/delete', 'id' => $task->id], ['class' => 'btn-sm btn-danger index-modal-link']) ?>
    <?= Html::endTag('div') ?>
<?php endif ?>
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