<?php

/* @var $this yii\web\View */
/* @var $projects array */

/* @var $last5tasks array */

use yii\helpers\Html;
use common\widgets\Alert;

$this->title = Yii::t('app', 'Admin Cache');
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="content">
    <div class="row">
        <div class="col-md-12 box">
            <div class="box-body">
                <?php if (!empty($alertSuccess)) : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?= $alertSuccess ?>
                    </div>
                <?php endif ?>
                <?= Html::a(Yii::t('app', 'Clear database schema cache'), ['clear-schema'], ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</div>
