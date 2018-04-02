<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a(Yii::t('app', 'Create new project'), ['project/create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    <div class="row">
        <?php foreach ($userProjects as $project) : $project = $project->toArray(); ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $project['name'] ?></h3>
                        <?php if (!empty($project['description'])) : ?>
                            <p><?= $project['description'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    <?= Html::a(Yii::t('app', 'View project') . ' <i class="fa fa-arrow-circle-right"></i>', ['project/view', 'id' => $project['id']], ['class' => 'small-box-footer']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
