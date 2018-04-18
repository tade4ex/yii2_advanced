<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = Yii::t('app', 'Delete Task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'pjax-modal-container',]) ?>
<?= Html::beginTag('div', ['class' => 'jumbotron'])?>
<?= Html::tag('p', Yii::t('app', 'Are you sure to delete this task?'), []) ?>
<?= Html::beginTag('p', []) ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'complete')->hiddenInput(['value' => '1'])->label('') ?>
<?= Html::submitButton(Yii::t('app', 'Yes'), ['class' => 'btn btn-success btn-lg', 'role' => 'button']) ?>
<?= ' ' ?>
<?= Html::button(Yii::t('app', 'No'), ['class' => 'btn btn-danger btn-lg', 'type' => 'button',  'data-dismiss' => 'modal']) ?>
<?php ActiveForm::end(); ?>
<?= Html::endTag('p') ?>
<?= Html::endTag('div') ?>
<?php Pjax::end() ?>