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


<?= Html::beginTag('div', ['class' => 'content']) ?>
    <!-- header -->
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?= Html::beginTag('div', ['class' => 'col-md-12']) ?>
<?= Html::tag('p',
    Html::a(Yii::t('app', 'Create project'), ['/project/create'], ['class' => 'btn btn-success index-modal-link'])
    , []
) ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
    <!-- projects -->
<?= Html::beginTag('div', ['class' => 'row']) ?>
<?php foreach ($projects as $project) : ?>
    <?= $this->render('//project/_view_project', [
        'project' => $project
    ]) ?>
<?php endforeach; ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>