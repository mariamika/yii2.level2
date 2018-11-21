<?php
namespace app\components\notifications;
use Yii;

class DeadlineNotification
{
    /**
     * @param $model
     */
    static public function sendNotification($model){

        $message = "Уважаемый/ая {$model->performer->name}! 
        Срок исполнения задачи номер {$model->id_task} \"{$model->taskName}\" закончится завтра!
        Поспешите выполнить свою задачу.";

        echo'Сообщение отправлено!'; var_dump($message);

//        Yii::$app->mailer
//            ->compose()
//            ->setTo($model->performer->email)
//            ->setSubject('Warning! Deadline Task')
//            ->setTextBody($message)
//            ->send();

    }

}