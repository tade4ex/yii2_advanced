<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_notification".
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_sub_event_id
 * @property int $sent
 */
class UserNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_sub_event_id'], 'required'],
            [['user_id', 'user_sub_event_id'], 'integer'],
            [['sent'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user_sub_event_id' => 'User Sub Event ID',
            'sent' => 'Sent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(UserSubEvent::className(), ['id' => 'user_sub_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUserId()
    {
        return $this->hasOne(UserSub::className(), ['user_id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $subscribe = UserSub::findOne(['user_id' => $this->user_id, 'user_sub_event_id' => $this->user_sub_event_id]);
            if (empty($subscribe)) {
                return false;
            }
        }
        return parent::beforeSave($insert);
    }
}
