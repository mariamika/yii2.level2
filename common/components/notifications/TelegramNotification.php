<?php
namespace common\components\notifications;


use common\models\Project;
use common\models\Subscribers;
use common\models\Tasks;
use SonkoDmitry\Yii\TelegramBot\Component;

class TelegramNotification
{
    /**
     * @param $model
     * @param $evParams
     * @throws \TelegramBot\Api\Exception
     * @throws \TelegramBot\Api\InvalidArgumentException
     */
    static public function sendNotification ($model, $evParams)
    {
        /**
         * @var Component $bot
         */

        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT,20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT,10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Except:']);

        switch ($evParams[0]){
            case 'task':
                Tasks::findOne($model->taskName);
                break;

            case 'project':
                Project::findOne($model->projectName);
                break;
        }

        $subscribe = Subscribers::find()
            ->where('event = :ev')
            ->addParams([':ev' => $evParams[0]])
            ->all();
        $text = "";

        foreach ($subscribe as $item){

            switch ($evParams[1]) {
                case 'taskCreate':
                    $text .= "Оповещение! \nСоздана задача \"{$model->taskName}\".";
                    break;

                case 'projectCreate':
                    $text .= "Оповещение! \nСоздан новый проект \"{$model->projectName}\".";
                    break;

                case 'projectUpdate':
                    $text .= "Оповещение! \nВ проект \"{$model->projectName}\" внесены изменения.";
            }


            $bot->sendMessage($item->getAttribute('subscriber'), $text);
        }
    }

}