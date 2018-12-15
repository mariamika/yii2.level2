<?php
namespace console\controllers;
use common\models\Subscribers;
use common\models\TelegramOffset;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use yii\console\Controller;

class TelegramController extends Controller
{
    /**
     * @var Component
     */
    private $bot;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    public function actionIndex()
    {
        while (true){
            $updates = $this->bot->getUpdates(TelegramOffset::getOffset() + 1);
            $updCount = count($updates);
            if ($updCount > 0){
                echo 'Новых сообщений: ' . $updCount . PHP_EOL;
                foreach ($updates as $update){
                    TelegramOffset::updateOffset($update);
                    if ($message = $update->getMessage()){
                        $this->processCommand($message);
                    }
                }
            } else {
                echo 'Новых сообщений нет.' . PHP_EOL;
            }
        }
    }

    private function processCommand(Message $message)
    {
        $params = explode(' ',$message->getText());
        $command = $params[0];

        $response = "";
        switch ($command){
            case '/help':
                $response = "Доступные команды \n";
                $response .= "/help - список комманд \n";
                $response .= "/subscribe_project - подписка на оповещение о создании и обновлении проекта \n";
                $response .= "/subscribe_task - подписка на оповещение о создании новой задачи \n";
                break;

            case '/subscribe_project':
                $check = Subscribers::checkData($message, 'project', $response);
                if ($check){
                    $response .= $check;
                    break;
                } else {
                    $response .= "Произошла ошибка. Попробуйте снова! \n";
                    break;
                }


            case '/subscribe_task':
                $check = Subscribers::checkData($message, 'task', $response);
                if ($check){
                    $response .= $check;
                    break;
                } else {
                    $response .= "Произошла ошибка. Попробуйте снова! \n";
                    break;
                }


            default:
                $response = "\n Несуществующая команда!";
                break;
        }

        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }
}