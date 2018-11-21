<?php
namespace common\components\eventComponents;
use common\components\notifications\TaskNotification;
use common\models\Tasks;
use yii\base\Component;
use yii\base\Event;

class EventComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Tasks::className(),Tasks::EVENT_AFTER_INSERT,function (Event $event){
            TaskNotification::sendNotification($event->sender);
        });
    }


}