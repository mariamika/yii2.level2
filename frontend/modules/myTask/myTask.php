<?php

namespace frontend\modules\myTask;

/**
 * myTask module definition class
 */
class myTask extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\myTask\controllers';
    public $defaultRoute = 'task';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
