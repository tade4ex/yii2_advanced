<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskContainer */

$this->title = Yii::t('app', 'Create Task Container');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Containers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>