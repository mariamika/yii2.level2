<?php

namespace frontend\modules\projects;

/**
 * Projects module definition class
 */
class Projects extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\projects\controllers';
    public $defaultRoute = 'project';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
