<?php
namespace frontend\modules\api\controllers;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
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
}