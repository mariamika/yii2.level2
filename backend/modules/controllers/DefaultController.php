<?php

namespace backend\modules\controllers;

use common\models\Tasks;
use frontend\modules\tasks\controllers\ListController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model_tasks = ListController::findModel();
        $dataProvider1 = new ActiveDataProvider([
            'query' => $model_tasks,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        $model_overdue_tasks = Tasks::find()
            ->joinWith(['performer','user'])
            ->select(['tasks.*','performer.*','user.*'])
            ->andWhere('tasks.dateDeadline > DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
            ->andWhere('tasks.statusTask != 0');
        $dataProvider3 = new ActiveDataProvider([
            'query' => $model_overdue_tasks,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        $model_end_tasks = Tasks::find()
            ->joinWith(['performer','user'])
            ->select(['tasks.*','performer.*','user.*'])
            ->andWhere('tasks.statusTask = 0');;
        $dataProvider2 = new ActiveDataProvider([
            'query' => $model_end_tasks,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index',[
            'model_tasks' => $dataProvider1,
            'model_end_tasks' => $dataProvider2,
            'model_overdue_tasks' => $dataProvider3,
        ]);
    }
}
