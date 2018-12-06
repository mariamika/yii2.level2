<?php

namespace frontend\modules\chat\controllers;

use common\models\Comment;

class CommentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = \Yii::$app->user->id;
        $message = \Yii::$app->request->post('message');
        $task_id = \Yii::$app->request->post('task_id');
        $model = new Comment();
        $model->user_id = $user;
        $model->message = $message;
        $model->task_id = $task_id;
        if ($model->save())
        {return true;} else {return false;}
    }

}
