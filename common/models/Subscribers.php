<?php

namespace common\models;

use TelegramBot\Api\Types\Message;

/**
 * This is the model class for table "subscribers".
 *
 * @property int $id
 * @property int $subscriber
 * @property string $event
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscriber', 'event'], 'required'],
            [['subscriber'], 'integer'],
            [['event'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscriber' => 'Subscriber',
            'event' => 'Event',
        ];
    }

    static public function checkData(Message $message, $params, $response)
    {
        $model = Subscribers::find()
            ->where('subscriber = :id')
            ->andWhere('event = :ev')
            ->addParams([':id' => $message->getFrom()->getId(), ':ev' => $params])
            ->all();

        if (empty($model)){
            $subscribe = new Subscribers([
                'subscriber' => $message->getFrom()->getId(),
                'event' => $params,
            ]);
            if ($subscribe->save()){
                $response .= "Вы подписаны на оповещения \n";
                return $response;
            }
        } else {
            $response .= "У вас уже имеется подписка.";
            return $response;
        }
        return false;
    }
}
