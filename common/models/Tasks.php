<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id_task
 * @property string $taskName
 * @property string $description
 * @property int $statusTask
 * @property int $namePerformer
 * @property int $priority
 * @property int $creator
 * @property string $dateCreate
 * @property string $dateDeadline
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Files
 * @property Performer
 * @property User
 * @property Comment
 * @property Project
 */
class Tasks extends \yii\db\ActiveRecord
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
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskName', 'namePerformer', 'priority', 'dateCreate','description','creator'], 'required'],
            [['namePerformer', 'priority','statusTask','creator'], 'integer'],
            [['dateCreate', 'dateDeadline'], 'safe'],
            [['taskName','description'], 'string', 'max' => 250],
            [['dateDeadline'], 'default', 'value' => function(){
                return $this->dateCreate;}],
            [['dateDeadline'], 'common\components\validators\DeadlineValidator'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_task' => 'Id Task',
            'taskName' => 'Task Name',
            'description' => 'Description',
            'namePerformer' => 'Performer',
            'creator' => 'Creator',
            'priority' => 'Priority',
            'statusTask' => 'Status',
            'dateCreate' => 'Date Create',
            'dateDeadline' => 'Date Deadline',
        ];
    }

    static public function getDate($id){

        return Tasks::find()
            ->joinWith(['performer','user'])
            ->select(['tasks.*','performer.*','user.*'])
            ->where('performer.id_users = :id_users')
            ->andWhere('tasks.creator = :user_id')
            ->addParams([':id_users' => $id, ':user_id' => $id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['tasks_id' => 'id_task']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(Performer::className(), ['index' => 'namePerformer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['task_id' => 'id_task']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id_project' => 'project_id']);
    }
}
