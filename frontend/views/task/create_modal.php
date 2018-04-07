<?php

use kartik\datetime\DateTimePicker;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $model \app\models\TaskContainer */

?>

<?php Modal::begin([
    'id' => 'create-task-modal',
    'header' => '<h2>' . Yii::t('app', 'Create task') . '</h2>',
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => false
    ],
]) ?>

    <div class="project-form">

        <?php $form = ActiveForm::begin([
            'action' => '/task/create',
            'options' => [
                'data-pjax' => true
            ],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'start')->widget(DateTimePicker::className(), [
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'y-m-d H:i:s',
                'startDate' => date('Y-m-d H:i:s'),
                'todayHighlight' => true
            ],
        ]) ?>

        <?= $form->field($model, 'end')->widget(DateTimePicker::className(), [
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'y-m-d H:i:s',
                'startDate' => date('Y-m-d H:i:s'),
                'todayHighlight' => true
            ],
        ]) ?>

        <?= $form->field($model, 'project_id')->hiddenInput([
            'value' => Yii::$app->request->get('id')
        ])->label(false) ?>

        <?= $form->field($model, 'task_container_id')->hiddenInput([
            'value' => Yii::$app->request->get('task_container_id')
        ])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['view', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php Modal::end() ?>