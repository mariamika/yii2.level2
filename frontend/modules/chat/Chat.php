<?php

namespace frontend\modules\chat;

/**
 * chat module definition class
 */
class Chat extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\chat\controllers';
    public $defaultRoute = 'comment';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
