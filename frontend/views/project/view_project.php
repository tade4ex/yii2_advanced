<?php

/* @var $project \app\models\Project */

use yii\helpers\Html;

?>
    <!-- project -->
<?= Html::beginTag('div', ['class' => 'col-md-4']) ?>
<?= Html::beginTag('div', ['class' => 'box box-success']) ?>
    <!-- project header -->
<?= Html::beginTag('div', ['class' => 'box-header with-border']) ?>
<?= Html::tag('h3', ' ', []) ?>
<?= Html::beginTag('div', ['class' => 'box-tools pull-right']) ?>
<?= Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project->id], ['class' => 'btn-sm btn-success']) ?>
<?= ' ' ?>
<?= Html::a(Yii::t('app', 'Update project'), ['/project/update', 'id' => $project->id], ['class' => 'btn-sm btn-primary index-modal-link']) ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
    <!-- project body-->
<?= Html::beginTag('div', ['class' => 'box-body']) ?>
<?= Html::tag('h3', $project->name, ['class' => 'box-title']) ?>
<?php if (!empty($project->description)) : ?>
    <?= Html::tag('p', $project->description, []) ?>
<?php endif; ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>