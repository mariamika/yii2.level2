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
 */
class Project extends \yii\db\ActiveRecord
{
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
            [['projectName'], 'required'],
            [['project_status'], 'integer'],
            [['projectName', 'description', 'responsible'], 'string', 'max' => 255],
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
}
