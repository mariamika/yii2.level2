<?php
namespace common\components\notifications;

use common\models\Performer;
use Yii;

class TaskNotification
{
    /**
     * @param $model
     */
    static public function sendNotification($model){
        $performer = Performer::findOne($model->namePerformer);


        $message = "Уважаемый/ая {$performer->name}! Для Вас добавлена новая задача \"{$model->taskName}\".
            Необходимо сдать её к {$model->dateDeadline}";

        //echo'Сообщение отправлено!<br><pre>'; var_dump($message); exit;

        Yii::$app->mailer
            ->compose()
            ->setTo($performer->email)
            ->setSubject('New Task')
            ->setTextBody($message)
            ->send();
    }

}