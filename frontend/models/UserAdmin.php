<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_admin".
 *
 * @property int $id
 * @property int $user_id
 * @property int $active
 */
class UserAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserAdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserAdminQuery(get_called_class());
    }
}
