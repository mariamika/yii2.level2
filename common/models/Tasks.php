<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id_task
 * @property string $taskName
 * @property int $namePerformer
 * @property int $priority
 * @property string $dateCreate
 * @property string $dateDeadline
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Files
 * @property Performer
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
            [['taskName', 'namePerformer', 'priority', 'dateCreate'], 'required'],
            [['namePerformer', 'priority'], 'integer'],
            [['dateCreate', 'dateDeadline'], 'safe'],
            [['taskName'], 'string', 'max' => 100],
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
            'namePerformer' => 'Performer',
            'priority' => 'Priority',
            'dateCreate' => 'Date Create',
            'dateDeadline' => 'Date Deadline',
        ];
    }

    static public function getDate($id){
        return Tasks::find()
            ->select(['tasks.*','performer.*','user.*'])
            ->from('tasks')
            ->join('LEFT OUTER JOIN','performer','performer.index = tasks.namePerformer')
            ->join('LEFT OUTER JOIN','user','user.id = performer.id_users')
            ->where('performer.id_users = :id_users')
            ->addParams([':id_users' => $id]);
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
        return $this->hasMany(Comment::className(), ['id_task' => 'id_task']);
    }
}
