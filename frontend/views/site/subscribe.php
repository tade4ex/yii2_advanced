<?php

$this->title = Yii::t('app', 'Subscribe');
$this->params['breadcrumbs'][] = $this->title;
$username = \app\models\User::findOne(['id' => Yii::$app->user->id])->username;

?>
<div class="content">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-body">
                <h3>TELEGRAM:</h3>
                <p><b>Subscribe create project command:</b> <code>/subscribe_project_create <?= $username ?></code></p>
                <p><b>Subscribe update project command:</b> <code>/subscribe_project_update <?= $username ?></code></p>
                <p><b>Subscribe create task command:</b> <code>/subscribe_task_create <?= $username ?></code></p>
                <p><b>Subscribe update task command:</b> <code>/subscribe_task_update <?= $username ?></code></p>
            </div>
        </div>
    </div>
</div>