<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProjectSearch represents the model behind the search form of `common\models\Project`.
 */
class ProjectSearch extends Project
{
    public $responsibleProject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'project_status', 'responsible'], 'integer'],
            [['projectName', 'description'], 'string'],
            [['responsibleProject'], 'safe'],
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
        $query = Project::find()
            ->joinWith(['user'])
            ->select(['project.*','user.*']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_project' => SORT_ASC]],
            'pagination' => [
                'pageSize' => 5
            ],
        ]);

        $dataProvider->sort->attributes['responsibleProject'] = [
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
            'id_project' => $this->id_project,
            'project_status' => $this->project_status,
        ]);

        $query->andFilterWhere(['like', 'projectName', $this->projectName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.username', $this->responsibleProject]);

        return $dataProvider;
    }
}
