<?php

namespace frontend\modules\tasks\controllers;

use common\models\Comment;
use common\models\Files;
use common\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Tasks controller for the `tasks` module
 */
class ListController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $model = $this->findModel();
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index', [
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

    static public function findModel(){

        return Tasks::find()
            ->joinWith(['performer','user'])
            ->select(['tasks.*','performer.*','user.*']);
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
