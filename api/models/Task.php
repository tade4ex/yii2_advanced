<?php

namespace app\models;

use common\models\UserNotification;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $description
 * @property string $start
 * @property string $end
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends ActiveRecord
{
    const TASK_CREATE_EVENT = 3;
    const TASK_UPDATE_EVENT = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start', 'end', 'project_id'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if (!empty($this->start)) {
            $this->start.= ':00';
        }
        if (!empty($this->end)) {
            $this->end.= ':00';
        }
        if ($this->isNewRecord) {
            $this->user_id = Yii::$app->user->id;
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $notify = new UserNotification();
        $notify->user_id = Yii::$app->user->id;
        if ($insert) {
            $notify->user_sub_event_id = self::TASK_CREATE_EVENT;
        } else {
            $notify->user_sub_event_id = self::TASK_UPDATE_EVENT;
        }
        $notify->save();
        parent::afterSave($insert, $changedAttributes);
    }
}
