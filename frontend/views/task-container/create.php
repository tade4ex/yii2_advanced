<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskContainer */

$this->title = Yii::t('app', 'Create Task Container');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Containers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-container-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
