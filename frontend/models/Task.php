<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $project_id
 * @property int $task_container_id
 * @property string $start
 * @property string $end
 * @property int $complete
 * @property string $created_at
 * @property string $update_at
 *
 * @property Project $project
 * @property TaskContainer $taskContainer
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
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
            [['name', 'user_id', 'project_id', 'task_container_id', 'created_at', 'update_at'], 'required'],
            [['description'], 'string'],
            [['user_id', 'project_id', 'task_container_id'], 'integer'],
            [['start', 'end', 'created_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['complete'], 'string', 'max' => 1],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['task_container_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskContainer::className(), 'targetAttribute' => ['task_container_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'user_id' => Yii::t('app', 'User ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'task_container_id' => Yii::t('app', 'Task Container ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'complete' => Yii::t('app', 'Complete'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskContainer()
    {
        return $this->hasOne(TaskContainer::className(), ['id' => 'task_container_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
