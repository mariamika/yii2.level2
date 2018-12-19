<?php

namespace frontend\modules\api\controllers;
use yii\rest\ActiveController;

class MessageController extends ActiveController
{
    public $modelClass = 'common\models\Message';
}
