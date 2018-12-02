<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "comment".
 *
 * @property int $id_comment
 * @property int $user_id
 * @property int $task_id
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Tasks
 */
class Comment extends \yii\db\ActiveRecord
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
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    static public function getDate($id_task){
        return Comment::find()
            ->joinWith(['tasks'])
            ->select(['comment.*','tasks.*'])
            ->where('comment.task_id = :id_task')
            ->addParams([':id_task' => $id_task])
            ->orderBy(['id_comment' => SORT_DESC])
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasOne(Tasks::className(), ['id_task' => 'task_id']);
    }
}
