<?php
namespace frontend\modules\api\controllers;
use common\models\Comment;
use common\models\Files;
use common\models\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 *
 * Для просмотра всех задач необходимо сделать запрос - GET http://front.yii.local/api/task
 * Для просмотра одной задачи ставим слэш и номер задачи - GET http://front.yii.local/api/task/2
 * Для просмотра задач по нескольким параметрам используем поиск в формате /search?name=value&name2=value2 . Например GET http://front.yii.local/api/task/search?priority=2&creator=1&taskName=gnn
 * Для удаления конкретной задачи используем запрос DELETE и указываем id задачи через слэш. DELETE http://front.yii.local/api/task/2
 * ВНИМАНИЕ! Для удаляемой задачи также будут удалены комментарии и файлы, прикрепленные к этой задаче.
 * Для создания новой задачи необходимо сделать запрос типа POST http://front.yii.local/api/task/create и указав все необходимые поля к заполнению
 *
 * Например:
 * {
    "taskName": "Name",
    "description": "Description",
    "statusTask": 1,
    "namePerformer": 4,
    "priority": 1,
    "creator": 2,
    "dateCreate": "2018-12-27",
    "project_id": 4
 * }
 *
 */
class TaskController extends ActiveController
{
    public $modelClass = 'common\models\Tasks';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function($username, $password){
                $user = User::findByUsername($username);
                if ($user !== null && $user->validatePassword($password)){
                    return $user;
                }
                return null;
            }
        ];

        return $behaviors;
    }

    public function actionSearch(){
        $requestParams = \Yii::$app->getRequest()->getBodyParams();

        if (empty ($requestParams)) {
            $requestParams = \Yii::$app->getRequest()->getQueryParams();
        }

        $modelClass = $this->modelClass;

        $query = $modelClass::find();
        if (!empty($requestParams)){
            foreach ($requestParams as $key => $value){
                $query->andFilterWhere(['like', $key, $value]);
            }
        }

        return \Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $query,
            'pagination' => [
                'params' => $requestParams,
            ],
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }

    public function actionDel($id) {
        Comment::deleteAll(['task_id' => $id]);
        Files::deleteAll(['tasks_id' => $id]);
        Tasks::deleteAll(['id_task' => $id]);
        return true;
    }
}