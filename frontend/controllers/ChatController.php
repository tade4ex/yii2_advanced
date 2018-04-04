<?php

namespace frontend\controllers;

use common\models\User;
use frontend\assets\ChatAsset;
use inpassor\realplexor\Realplexor;
use Yii;
use app\models\Chat;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{
    public $rpl;
    /**
     * @return string
     */
    public function actionIndex()
    {
        ChatAsset::register($this->view);

        $messages = Chat::find()->all();

        return $this->render('index', [
            'messages' => $messages
        ]);
    }

    public function actionSeenMessage()
    {
        $messageId = Yii::$app->request->post('message_id');
        if (($chat = Chat::findOne($messageId)) !== null) {
            $chat->seen_at = date('Y-m-d h:i:s');
            $chat->seen = 1;
            $chat->save();
        }
    }

    public function actionSendMessage()
    {
        $userToId = Yii::$app->request->post('user_to_id');
        $message = Yii::$app->request->post('message');

        $chat = new Chat();
        $chat->user_from_id = Yii::$app->user->id;
        $chat->user_to_id = $userToId;
        $chat->message = $message;
        $chat->send_at = date('Y-m-d h:i:s');
        $chat->save();
        $user = User::findOne(Yii::$app->user->id);
        Yii::$app->realplexor->send('user' . $userToId, [
            'message' => $message,
            'message_id' => $chat->id,
            'date_time' => $chat->send_at,
            'fio' => $user->getAttribute('name') . ' ' . $user->getAttribute('surname'),
        ]);
        return json_encode([]);
    }
}
