<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = Yii::t('app', 'Create Task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'pjax-modal-container',]) ?>
<?= Html::tag('h1', Html::encode($this->title), []) ?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
<?php Pjax::end() ?>