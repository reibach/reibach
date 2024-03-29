<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Offer;

/**
 * OfferSearch represents the model behind the search form about `frontend\models\Offer`.
 */
class OfferSearch extends Offer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mandator_id', 'customer_id'], 'integer'],
            [['description', 'offer_number', 'offer_date', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'number'],
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
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		
		$query = Offer::find()
			->where(['mandator_id' => $mandator_active]);



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
            'mandator_id' => $this->mandator_id,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'offer_date' => $this->offer_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'offer_number', $this->offer_number]);

        return $dataProvider;
    }
}
