<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $messages \app\models\Chat */

$this->title = Yii::t('app', 'Chats');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->
<div class="box box-danger direct-chat direct-chat-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Direct Chat</h3>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <div class="direct-chat-messages">
            <?php foreach ($messages as $message) : $userFrom = $message->getFromUser()->one(); ?>
                <div class="direct-chat-msg <?= ($message->getAttribute('user_from_id') == Yii::$app->user->id ? '' : 'right') ?>">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-<?= ($message->getAttribute('user_from_id') == Yii::$app->user->id ? 'left' : 'right') ?>"><?= $userFrom->getAttribute('name') ?> <?= $userFrom->getAttribute('surname') ?></span>
                        <span class="direct-chat-timestamp pull-<?= ($message->getAttribute('user_from_id') == Yii::$app->user->id ? 'right' : 'left') ?>"><?= $message->getAttribute('send_at') ?></span>
                    </div>
                    <div class="direct-chat-text">
                        <?= $message->getAttribute('message') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="box-footer">
        <div class="input-group">
            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
            <span class="input-group-btn">
                <button id="send-message" type="button" class="btn btn-danger btn-flat">Send</button>
                </span>
        </div>
    </div>
</div>
<script>var userIdFrom = <?= Yii::$app->user->id; ?>;</script>
<script>var userIdTo = <?= Yii::$app->user->id === 1 ? 2 : 1; ?>;</script>
<!--/.direct-chat -->