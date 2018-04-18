<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = Yii::t('app', 'Task') . ': ' . $model->name;
\common\helpers\LastTask::saveUrl();

?>

<?= Html::beginTag('div', ['class' => 'box']) ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'description',
        'created_at:datetime',
    ],
]) ?>

<?= Html::endTag('div') ?>

