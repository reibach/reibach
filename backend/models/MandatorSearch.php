<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mandator;

/**
 * MandatorSearch represents the model behind the search form about `backend\models\Mandator`.
 */
class MandatorSearch extends Mandator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'address_id', 'taxable', 'b_id', 'c_id'], 'integer'],
            [['mandator_name', 'signature'], 'safe'],
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
        $query = Mandator::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'taxable' => $this->taxable,
            'b_id' => $this->b_id,
            'c_id' => $this->c_id,
        ]);

        $query->andFilterWhere(['like', 'mandator_name', $this->mandator_name])
            ->andFilterWhere(['like', 'signature', $this->signature]);

        return $dataProvider;
    }
}
