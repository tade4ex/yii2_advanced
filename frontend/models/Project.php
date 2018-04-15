<?php

namespace app\models;

use Yii;
use common\models\UserNotification;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Project extends \yii\db\ActiveRecord
{
    const PROJECT_CREATE_EVENT = 1;
    const PROJECT_UPDATE_EVENT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
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
            'parent_id' => Yii::t('app', 'Parent project'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function beforeSave($insert)
    {
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
            $notify->user_sub_event_id = self::PROJECT_CREATE_EVENT;
        } else {
            $notify->user_sub_event_id = self::PROJECT_UPDATE_EVENT;
        }
        $notify->save();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ProjectQuery(get_called_class());
    }

    /**
     * @return $this|query\ProjectQuery
     */
    public function getParentsToSelect()
    {
        $project = Project::find()->andWhere(['user_id' => Yii::$app->user->id]);
        if (!empty($this->id)) {
            return $project->andWhere(['!=', 'id', $this->id]);
        }
        return $project;
    }

    public function getChildProjects()
    {
        return $this->hasMany(Project::className(), ['parent_id' => 'id']);
    }

    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
    }
}
