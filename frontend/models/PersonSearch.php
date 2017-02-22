<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Person;

/**
 * PersonSearch represents the model behind the search form about `frontend\models\Person`.
 */
class PersonSearch extends Person
{

	/* your calculated attribute */
	public $countryName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'parent_id'], 'integer'],
            [['first_name', 'last_name', 'countryName'], 'safe']
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
        $query = Person::find();

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
			'attributes' => [
				'id',
				'fullName' => [
					'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
					'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
					'label' => 'Full Name',
					'default' => SORT_ASC
				],
				'countryName' => [
					'asc' => ['tbl_country.country_name' => SORT_ASC],
					'desc' => ['tbl_country.country_name' => SORT_DESC],
					'label' => 'Country Name'
				]
			]
		]);

		if (!($this->load($params) && $this->validate())) {
			/**
			 * The following line will allow eager loading with country data 
			 * to enable sorting by country on initial loading of the grid.
			 */ 
			$query->joinWith(['country']);
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'first_name', true);
		$this->addCondition($query, 'last_name', true);
		$this->addCondition($query, 'country_id');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		/* Add your filtering criteria */
	 
		// filter by person full name
		$query->andWhere('first_name LIKE "%' . $this->fullName . '%" ' .
			'OR last_name LIKE "%' . $this->fullName . '%"'
		);
	 
		// filter by country name
		$query->joinWith(['country' => function ($q) {
			$q->where('tbl_country.country_name LIKE "%' . $this->countryName . '%"');
		}]);
	 
		return $dataProvider;    
	}
}
