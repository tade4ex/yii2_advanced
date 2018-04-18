<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Html::beginTag('div', ['class' => 'task-form']) ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'project_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(
        \app\models\Project::findAll(['user_id' => Yii::$app->user->id]), 'id', 'name'
    )
) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'start')->widget(DateTimePicker::className(), [
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd hh:ii',
        'autoclose' => true,
    ],
]) ?>
<?= $form->field($model, 'end')->widget(DateTimePicker::className(), [
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd hh:ii',
        'autoclose' => true,
    ],
]) ?>
<?= Html::tag('div',
    Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])
    , ['class' => 'form-group']
) ?>
<?php ActiveForm::end(); ?>
<?= Html::endTag('div') ?>
