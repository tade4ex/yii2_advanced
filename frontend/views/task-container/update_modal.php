<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $model \app\models\TaskContainer */

?>

<?php Modal::begin([
    'id' => 'update-container-modal',
    'header' => '<h2>' . Yii::t('app', 'Update task container') . '</h2>',
]) ?>

    <div class="task-container-form">

        <?php $form = ActiveForm::begin([
            'action' => '/task-container/update/?id=' . $model->id,
            'options' => [
                'data-pjax' => true
            ],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'project_id')->hiddenInput([
            'value' => Yii::$app->request->get('id')
        ])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['view', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php Modal::end() ?>