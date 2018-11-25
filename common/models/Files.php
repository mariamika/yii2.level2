<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property int $id_file
 * @property string $name
 * @property string $address_big_picture
 * @property string $address_small_picture
 * @property int $tasks_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Tasks $tasks
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $file;

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
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','address_big_picture','address_small_picture'],'string'],
            [['tasks_id'],'integer'],
            [['file'], 'file', 'extensions' => 'jpg, png, gif', 'maxFiles' => 5],
        ];
    }

    public function uploadFile(){
        if ($this->validate()){
            foreach ($this->file as $file){
                $baseName = $file->getBaseName() . '.' . $file->getExtension();
                $fileName = '@backend/web/img/big/' . $baseName;
                $file->saveAs(\Yii::getAlias($fileName),false);
                Image::thumbnail($fileName,100,100)
                    ->save(\Yii::getAlias('@backend/web/img/small/' . $baseName));
            }
            return true;
        } else {
            return false;
        }
    }

    static public function getDate($id_task){
        return Files::find()
            ->joinWith(['tasks'])
            ->select(['files.*','tasks.*'])
            ->where('files.tasks_id = :id_task')
            ->addParams([':id_task' => $id_task])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasOne(Tasks::className(), ['id_task' => 'tasks_id']);
    }
}
