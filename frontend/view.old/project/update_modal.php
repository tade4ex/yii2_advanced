<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $model \app\models\Project */

?>

<?php Modal::begin([
    'id' => 'update-project-modal',
    'header' => '<h2>' . Yii::t('app', 'Update project') . '</h2>',
]) ?>

    <div class="project-form">

        <?php $form = ActiveForm::begin([
            'action' => '/project/update/?id=' . $model->id,
            'options' => [
                'data-pjax' => true
            ],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'parent_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Project::find()->andWhere(['!=', 'id', $model->id])->all(), 'id', 'name'),
            ['prompt' => Yii::t('app', 'select')]
        ) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['view', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php Modal::end() ?>