<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mandator;

/**
 * MandatorSearch represents the model behind the search form about `frontend\models\Mandator`.
 */
class MandatorSearch extends Mandator
{
	public $fullName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'user_id', 'address_id'], 'integer'],
            [['id', 'user_id', 'address_id', 'taxable', 'b_id', 'c_id'], 'integer'],
            [['fullName'], 'save'],
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
        $query = Mandator::find()
		->where(['user_id' => Yii::$app->user->id]);
		
		
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
			]
		]);

        //$this->load($params);
          if (!($this->load($params) && $this->validate())) {
			/**
			 * The following line will allow eager loading with country data 
			 * to enable sorting by country on initial loading of the grid.
			 */ 
			$query->joinWith(['address']);
			return $dataProvider;
		}
    
		$query->andFilterWhere(['id' => $this->id]);
		$query->andFilterWhere(['like', 'prename', $this->prename]);
		$query->andFilterWhere(['like', 'lastname', $this->lastname]);
		$query->andFilterWhere(['address_id' => $this->address_id]);
		    
		// filter by person full name
		$query->andWhere('first_name LIKE "%' . $this->fullName . '%" ' .
			'OR last_name LIKE "%' . $this->fullName . '%"'
		);
    

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

        return $dataProvider;
    }
}
