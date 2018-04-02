<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>GU</b> task tracker</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?=Yii::t('app', 'Sign up')?></p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-signup',
            'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'name'); ?>

        <?= $form->field($model, 'surname'); ?>

        <?= $form->field($model, 'phone'); ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>