<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TaskSearch represents the model behind the search form of `common\models\Tasks`.
 */
class TaskSearch extends Tasks
{
    public $performer;
    public $creatorTask;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_task', 'priority', 'namePerformer','creator','statusTask'], 'integer'],
            [['taskName','description'],'string'],
            [['dateCreate', 'dateDeadline', 'performer','creatorTask'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tasks::find()
            ->joinWith(['performer','user'])
            ->select(['tasks.*','performer.*','user.*']);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_task' => SORT_ASC]],
            'pagination' => [
                'pageSize' => 5
            ],
        ]);

        $dataProvider->sort->attributes['performer'] = [
            'asc' => ['performer.name' => SORT_ASC],
            'desc' => ['performer.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['creatorTask'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_task' => $this->id_task,
            'priority' => $this->priority,
            'statusTask' => $this->statusTask,
        ]);

        $query->andFilterWhere(['like', 'taskName', $this->taskName])
            ->andFilterWhere(['like', 'dateCreate', $this->dateCreate])
            ->andFilterWhere(['like', 'dateDeadline', $this->dateDeadline])
            //->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.username', $this->creatorTask])
            ->andFilterWhere(['like', 'performer.name', $this->performer]);

        \Yii::$app->db->cache(function () use ($dataProvider) {
            $dataProvider->prepare();
        },10);
        return $dataProvider;
    }
}
