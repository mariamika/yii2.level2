<?php
namespace frontend\controllers;
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive()
    {
        /**
         * @var $bot Component
         */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT,20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT,10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Except:']);

        $updates = $bot->getUpdates();
        $messages = [];
        foreach ($updates as $update){
            $message = $update->getMessage();
            $username = $message->getFrom()->getUsername();
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username,
            ];
        }

        return $this->render('receive', ['messages' => $messages]);

    }

    public function actionSend()
    {
        /**
         * @var Component $bot
         */
        $bot = \Yii::$app->bot;
        $bot->sendMessage(34489419, 'Nu, vse ok!');
    }

}