<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Bill;

/**
 * BillSearch represents the model behind the search form about `frontend\models\Bill`.
 */
class BillSearch extends Bill
{
	/* your calculated attribute */
	public $positionPrice;
	public $fullName;
	public $billPrice;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
            [['description', 'fullName'], 'safe'],
            //[['description'], 'safe'],
            [['positionPrice'], 'safe'],
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
		
		$query = Bill::find()
			->where(['mandator_id' => $mandator_active]);
        

        // add conditions that should always apply here
		 $subQuery = Position::find()
			->select('bill_id, SUM(price), quantity as position_price')
			->groupBy('bill_id');
		$query->leftJoin(['positionSum' => $subQuery], 'positionSum.bill_id = id');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
         /**
		 * Setup your sorting attributes
		 * Note: This is setup before the $this->load($params) 
		 * statement below
		 */
		 $dataProvider->setSort([
			'attributes' => [
				'id',
				'name',
				'positionPrice' => [
					'asc' => ['positionSum.position_price' => SORT_ASC],
					'desc' => ['positionSum.position_price' => SORT_DESC],
					'label' => 'Position Name'
				]
			]
		]);        

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		/**
		 * Setup your sorting attributes
		 * Note: This is setup before the $this->load($params) 
		 * statement below
		 */
		 //$dataProvider->setSort([
			//'attributes'=>[
				//'id',
				//'fullName'=>[
					//'asc'=>['prename'=>SORT_ASC, 'lastname'=>SORT_ASC],
					//'desc'=>['prename'=>SORT_DESC, 'lastname'=>SORT_DESC],
					//'label'=>'Full Name',
					//'default'=>SORT_ASC
				//],
			//]
		//]);
		

		//$this->load($params);
        //if (!($this->load($params) && $this->validate())) {
			/**
			 * The following line will allow eager loading with country data 
			 * to enable sorting by country on initial loading of the grid.
			 */ 
			//$query->joinWith(['customer']);
			//return $dataProvider;
		//}
    
		//$query->andFilterWhere(['id' => $this->id]);
		//$query->andFilterWhere(['like', 'prename', $this->prename]);
		//$query->andFilterWhere(['like', 'lastname', $this->lastname]);
		//$query->andFilterWhere(['customer_id' => $this->customer_id]);

		// filter by person full name
		//$query->andWhere('first_name LIKE "%' . $this->fullName . '%" ' .
			//'OR last_name LIKE "%' . $this->fullName . '%"'
		//);


        //if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        //}

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

		// filter by position price
		$query->andWhere(['positionSum.position_price' => $this->positionPrice]);
 
        
        return $dataProvider;
    }
}
