<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "telegram_offset".
 *
 * @property int $id
 * @property int $offset
 */
class TelegramOffset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telegram_offset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offset'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offset' => 'Offset',
        ];
    }
}
