<?php

namespace app\models;

use common\models\UserNotification;
use Yii;

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
class Task extends \yii\db\ActiveRecord
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
            [['name', 'start', 'end'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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

    /**
     * @inheritdoc
     * @return \app\models\query\TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TaskQuery(get_called_class());
    }
}
