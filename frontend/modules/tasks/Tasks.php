<?php

namespace frontend\modules\tasks;

/**
 * tasks module definition class
 */
class Tasks extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\tasks\controllers';
    public $defaultRoute = 'list';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
