<?php

namespace deka6pb\simpleTodo\models\search;

use deka6pb\simpleTodo\models\Project;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use deka6pb\simpleTodo\models\Todo;

/**
 * TodotSearch represents the model behind the search form about `deka6pb\simpleTodo\models\Todo`.
 */
class TodoSearch extends Todo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'status', 'type'], 'integer'],
            [['date_start', 'created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function getDefaultParams() {
        $params = [];

        // add first project
        if(array_keys(Project::getProjectsList())) {
            $params['TodoSearch']['project_id'] = array_keys(Project::getProjectsList())[0];
        }

        return $params;
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
        $query = Todo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'author_id' => $this->author_id,
            'status' => $this->status,
            'type' => $this->type,
            'date_start' => $this->date_start,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
