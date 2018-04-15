<?php

namespace console\components;

use common\models\UserNotification;
use Yii;
use yii\base\Component;

class TelegramSendNotify extends Component
{
    const PROJECT_CREATE_EVENT = 1;
    const PROJECT_UPDATE_EVENT = 2;
    const TASK_CREATE_EVENT = 3;
    const TASK_UPDATE_EVENT = 4;

    public function sendOne()
    {
        $notification = UserNotification::findOne(['sent' => 0]);
        if (!empty($notification)) {
            try {
                /* @var $userSub \common\models\UserSub */
                $userSub = $notification->getTelegramUserId()->one();
                $telegramUserId = $userSub->telegram_user_id;
                /* @var $subEvent \common\models\UserSubEvent */
                $subEvent = $notification->getEvent()->one();
                $message = $subEvent->name;
                /* @var $bot \SonkoDmitry\Yii\TelegramBot\Component */
                $bot = Yii::$app->bot;
                $bot->sendMessage($telegramUserId, $message);
            } catch (\Exception $e) {
                return false;
            }
            $notification->sent = 1;
            $notification->save(false);
        }
    }
}