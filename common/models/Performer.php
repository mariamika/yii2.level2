<?php

namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "performer".
 *
 * @property int $index
 * @property string $name
 * @property string $email
 * @property int $id_users
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User
 * @property Tasks[] $tasks
 */
class Performer extends \yii\db\ActiveRecord
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
        return 'performer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email'], 'required'],
            [['email'],'email'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_users']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['namePerformer' => 'index']);
    }
}
