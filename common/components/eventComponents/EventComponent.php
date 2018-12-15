<?php
namespace common\components\eventComponents;
use common\components\notifications\TaskNotification;
use common\components\notifications\TelegramNotification;
use common\models\Project;
use common\models\Tasks;
use yii\base\Component;
use yii\base\Event;

class EventComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Tasks::className(), Tasks::EVENT_AFTER_INSERT, function (Event $event){
            TaskNotification::sendNotification($event->sender);
        });

        Event::on(Tasks::className(), Tasks::EVENT_AFTER_INSERT, function (Event $event){
            TelegramNotification::sendNotification($event->sender, ['task','taskCreate']);
        });

        Event::on(Project::className(), Project::EVENT_AFTER_INSERT, function (Event $event){
            TelegramNotification::sendNotification($event->sender, ['project','projectCreate']);
        });

        Event::on(Project::className(), Project::EVENT_AFTER_UPDATE, function (Event $event){
            TelegramNotification::sendNotification($event->sender, ['project','projectUpdate']);
        });
    }
}