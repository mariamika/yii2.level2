<?php

namespace frontend\modules\api;

/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\api\controllers';
    public $defaultRoute = 'task';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }
}
