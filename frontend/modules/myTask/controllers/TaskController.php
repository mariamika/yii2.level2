<?php

namespace frontend\modules\myTask\controllers;

use common\models\Comment;
use common\models\Files;
use common\models\Tasks;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function actionIndex(){

        if (is_null($id = \Yii::$app->user->id)){
            $id = '0';
        }

        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCard($id){
        return $this->render('card', [
            'model' => $this->findTask($id),
            'model_pic' => $this->findFiles($id),
            'model_comment' => $this->findComment($id)
        ]);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTask($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = Tasks::getDate($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }

    /**
     * Finds the Files model based on its id_task value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_task
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findFiles($id_task)
    {
        if (($model_pic = Files::getDate($id_task)) !== null) {
            return $model_pic;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Comment model based on its id_task value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_task
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findComment($id_task){
        if (($model_comment = Comment::getDate($id_task)) !== null){
            return $model_comment;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
