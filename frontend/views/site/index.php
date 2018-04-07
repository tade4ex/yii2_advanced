<?php

/* @var $this yii\web\View */
/* @var $userProjects \app\models\Project */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?php Pjax::begin() ?>
                    <?= Html::a(Yii::t('app', 'Create new project'), ['site/index', 'create-project-modal' => ''], ['class' => 'btn btn-success']) ?>
                    <?= $createProjectModal ?>
                    <?php $this->registerJs("$('#create-project-modal').modal('show');") ?>
                <?php Pjax::end() ?>
            </p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($userProjects as $project) : $project = $project->toArray(); ?>
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $project['name'] ?></h3>
                        <div class="box-tools pull-right">
                            <?= Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project['id']], ['class' => 'btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($project['description'])) : ?>
                            <p><?= $project['description'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>