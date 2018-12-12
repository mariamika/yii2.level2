<?php

namespace common\models;

/**
 * This is the model class for table "project".
 *
 * @property int $id_project
 * @property string $projectName
 * @property int $project_status
 * @property string $description
 * @property string $responsible
 *
 * @property Tasks
 * @property User
 */
class Project extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projectName','responsible'], 'required'],
            [['project_status','responsible'], 'integer'],
            [['projectName', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_project' => 'Id Project',
            'projectName' => 'Project Name',
            'project_status' => 'Project Status',
            'description' => 'Description',
            'responsible' => 'Responsible',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id_project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'responsible']);
    }
}
