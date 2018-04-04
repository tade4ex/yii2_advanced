<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
