<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Address;

/**
 * AddressSearch represents the model behind the search form about `frontend\models\Address`.
 */
class AddressSearch extends Address
{
	/* your calculated attribute */
	public $fullName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_user_id', 'update_user_id'], 'integer'],
             [['address_type', 'title', 'company', 'prename', 'lastname', 'zipcode', 'place', 'street', 'housenumber', 'state', 'phone_privat', 'phone_business', 'phone_mobile', 'email', 'fax', 'create_time', 'update_time'], 'safe'],
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
        $query = Address::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

    /**
     * Setup your sorting attributes
     * Note: This is setup before the $this->load($params) 
     * statement below
     */
    $dataProvider->setSort([
        'attributes'=>[
            'id',
            'fullName'=>[
                'asc'=>['prename'=>SORT_ASC, 'lastname'=>SORT_ASC],
                'desc'=>['prename'=>SORT_DESC, 'lastname'=>SORT_DESC],
                'label'=>'Full Name',
                'default'=>SORT_ASC
            ],
            //'country_id'
        ]
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
            'create_time' => $this->create_time,
            'create_user_id' => $this->create_user_id,
            'update_time' => $this->update_time,
            'update_user_id' => $this->update_user_id,
        ]);

        $query->andFilterWhere(['like', 'address_type', $this->address_type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'prename', $this->prename])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'street', $this->street])
		    ->andFilterWhere(['like', 'housenumber', $this->housenumber])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'phone_privat', $this->phone_privat])
            ->andFilterWhere(['like', 'phone_business', $this->phone_business])
            ->andFilterWhere(['like', 'phone_mobile', $this->phone_mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fax', $this->fax]);

        return $dataProvider;
    }
}
