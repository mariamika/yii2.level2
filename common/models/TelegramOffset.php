<?php

namespace common\models;

use TelegramBot\Api\Types\Update;

/**
 * This is the model class for table "telegramOffset".
 *
 * @property int $id
 * @property string $timestamp_offset
 */
class TelegramOffset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegramOffset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['timestamp_offset'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp_offset' => 'Timestamp Offset',
        ];
    }

    static public function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0){
            return $max;
        }
        return false;
    }

    static public function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s")
        ]);
        $model->save();
    }
}
