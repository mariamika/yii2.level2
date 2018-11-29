<?php

namespace common\models;

/**
 * This is the model class for table "comment".
 *
 * @property int $id_comment
 * @property int $id_user
 * @property int $id_task
 * @property string $message
 *
 * @property Tasks $task
 */
class Comment extends \yii\db\ActiveRecord
{
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
            [['id_user', 'id_task'], 'integer'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'id_user' => 'Id User',
            'id_task' => 'Id Task',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id_task' => 'id_task']);
    }
}
