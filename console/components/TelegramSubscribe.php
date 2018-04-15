<?php

namespace console\components;

use Yii;
use common\models\TelegramOffset;
use common\models\UserSub;
use common\models\User;
use yii\base\Component;

class TelegramSubscribe extends Component {
    const PROJECT_CREATE_EVENT = 1;
    const PROJECT_UPDATE_EVENT = 2;
    const TASK_CREATE_EVENT = 3;
    const TASK_UPDATE_EVENT = 4;

    protected $offset = 0;

    public function run()
    {
        $this->getOffset();
        $updates = Yii::$app->bot->getUpdates($this->offset + 1);
        if (count($updates) > 0) {
            echo "Found ".count($updates)." new messages \n";
        }
        foreach($updates as $update){
            $message = $update->getMessage();
            $this->updateOffset($update);
            $this->processCommand($message);
        }
    }

    protected function getOffset()
    {
        $max = TelegramOffset::find()->select("offset")->max("offset");
        if ($max > 0){
            $this->offset = $max;
        }
    }

    protected function updateOffset($update)
    {
        $new_offset_id = $update->getUpdateId();
        $new_offset = new TelegramOffset();
        $new_offset->offset = $new_offset_id;
        $new_offset->save();
    }

    protected function processCommand($message)
    {
        $full_message = explode(" ", $message->getText());
        $command = $full_message[0];
        $login = NULL;
        if(isset($full_message[1])){
            $login = $full_message[1];
        }
        switch ($command) {
            case '/help':
                $help = "Commands \n";
                $help .= "/subscribe_project_create %your login% - subscribe get info create new project \n";
                $help .= "/subscribe_project_update %your login% - subscribe get info update projects \n";
                $help .= "/subscribe_task_create %your login% - subscribe get info create new task \n";
                $help .= "/subscribe_task_update %your login% - subscribe get info update tasks \n";
                $help .= "\n";
                $help .= "More info http://advanced.test/site/subscribe";
                Yii::$app->bot->sendMessage($message->getFrom()->getID(), $help);
                break;
            case '/subscribe_project_create':
                Yii::$app->bot->sendMessage($message->getFrom()->getID(),
                    $this->createSubscription($login, $message, self::PROJECT_CREATE_EVENT)
                );
                break;
            case '/subscribe_project_update':
                Yii::$app->bot->sendMessage($message->getFrom()->getID(),
                    $this->createSubscription($login, $message, self::PROJECT_UPDATE_EVENT)
                );
                break;
            case '/subscribe_task_create':
                Yii::$app->bot->sendMessage($message->getFrom()->getID(),
                    $this->createSubscription($login, $message, self::TASK_CREATE_EVENT)
                );
                break;
            case '/subscribe_task_update':
                Yii::$app->bot->sendMessage($message->getFrom()->getID(),
                    $this->createSubscription($login, $message, self::TASK_UPDATE_EVENT)
                );
                break;
        }
    }

    protected function createSubscription($login, $message, $eventId)
    {
        $user = User::find()->where("username = :login", [':login' => $login])->one();
        if ($user) {
            $subscription = new UserSub();
            $subscription->user_id = $user->id;
            $subscription->telegram_user_id = $message->getFrom()->getID();
            $subscription->user_sub_event_id = $eventId;
            $subscription->save();
            return 'Subscription success!';
        } else {
            return 'User not found, please check command';
        }
    }
}