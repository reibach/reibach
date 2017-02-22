<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Position;

/**
 * PositionSearch represents the model behind the search form about `backend\models\Position`.
 */
class PositionSearch extends Position
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bill_id'], 'integer'],
            [['name', 'pos_num', 'unit', 'comment'], 'safe'],
            [['quantity', 'price', 'tax', 'amount'], 'number'],
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
        $query = Position::find();

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
            'bill_id' => $this->bill_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tax' => $this->tax,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'bill_id', $this->bill_id])
			->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pos_num', $this->pos_num])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchBillPos($params,$id)
    {
        $query = Position::find();

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
            'bill_id' => $this->bill_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tax' => $this->tax,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'bill_id', $id])
			->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pos_num', $this->pos_num])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
