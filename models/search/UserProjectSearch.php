<?php

namespace deka6pb\simpleTodo\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use deka6pb\simpleTodo\models\UserProject;

/**
 * UserProjectSearch represents the model behind the search form about `deka6pb\simpleTodo\models\UserProject`.
 */
class UserProjectSearch extends UserProject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'project_id'], 'integer'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserProject::find();

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
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
        ]);

        return $dataProvider;
    }
}
