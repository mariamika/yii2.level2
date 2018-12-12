<?php

namespace frontend\modules\projects\controllers;

use common\models\Project;
use common\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `projects` module
 */
class ProjectController extends Controller
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
                'pageSize' => 4
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCard ($id)
    {
        $model = $this->findTask($id);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 4
            ]
        ]);

        return $this->render('card', [
            'dataProvider' => $dataProvider,
            'idProject' => $id,
        ]);
    }

    static public function findModel()
    {
        return Project::find()
            ->joinWith(['user'])
            ->select(['user.*','project.*']);
    }

    static public function findTask($id)
    {
        return Tasks::find()
            ->joinWith(['user','performer','project'])
            ->select(['tasks.*','project.*','user.*','performer.*'])
            ->where('tasks.project_id = :id_project')
            ->addParams([':id_project' => $id]);
    }
}
