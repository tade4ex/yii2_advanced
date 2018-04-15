<?php

/* @var $this yii\web\View */
/* @var $projects array */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
$(document).ready(function() {
    $(document).on('click', '.index-modal-link', function () {
        $('#index-modal').modal({ show: true });
    });
});
");

?>

<?php Modal::begin([
    'id' => 'index-modal',
]) ?>
<?php Pjax::begin([
    'id' => 'pjax-modal-container',
    'linkSelector' => '.index-modal-link',
    'enablePushState' => false,
]) ?>
<?php Pjax::end() ?>
<?php Modal::end() ?>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a(Yii::t('app', 'Create project'), ['/project/create'], ['class' => 'btn btn-success index-modal-link']) ?>
            </p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($projects as $project) : /* @var $project \app\models\Project */ ?>
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3> </h3>
                        <div class="box-tools pull-right">
                            <?= Html::a(Yii::t('app', 'Show project'), ['/project/view', 'id' => $project->id], ['class' => 'btn-sm btn-success']) ?>
                            <?= Html::a(Yii::t('app', 'Update project'), ['/project/update', 'id' => $project->id], ['class' => 'btn-sm btn-primary index-modal-link']) ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <h3 class="box-title"><?= $project->name ?></h3>
                        <?php if (!empty($project->description)) : ?>
                            <p><?= $project->description ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>