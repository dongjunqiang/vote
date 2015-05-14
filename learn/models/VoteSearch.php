<?php

namespace learn\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use learn\models\Vote;

/**
 * VoteSearch represents the model behind the search form about `app\models\Vote`.
 */
class VoteSearch extends Vote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'total_votes', 'has_votes'], 'integer'],
            [['url', 'params', 'add_time', 'modify_time'], 'safe'],
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
        $query = Vote::find();

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
            'type' => $this->type,
            'total_votes' => $this->total_votes,
            'has_votes' => $this->has_votes,
            'add_time' => $this->add_time,
            'modify_time' => $this->modify_time,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
