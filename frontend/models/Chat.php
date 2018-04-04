<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $user_from_id
 * @property int $user_to_id
 * @property string $message
 * @property string $send_at
 * @property string $seen_at
 * @property int $seen
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_from_id' => Yii::t('app', 'User From ID'),
            'user_to_id' => Yii::t('app', 'User To ID'),
            'message' => Yii::t('app', 'Message'),
            'send_at' => Yii::t('app', 'Send At'),
            'seen_at' => Yii::t('app', 'Seen At'),
            'seen' => Yii::t('app', 'Seen'),
        ];
    }

    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_from_id']);
    }

    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_to_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ChatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ChatQuery(get_called_class());
    }
}
