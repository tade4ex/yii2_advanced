<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_sub".
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_sub_event_id
 * @property int $telegram_user_id
 */
class UserSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_sub_event_id'], 'required'],
            [['user_id', 'user_sub_event_id', 'telegram_user_id'], 'integer'],
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
            'telegram_user_id' => 'Telegram User ID',
        ];
    }
}
