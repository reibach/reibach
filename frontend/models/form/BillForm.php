<?php
namespace frontend\models\form;

use frontend\models\Bill;
use frontend\models\Position;
use frontend\models\Customer;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class BillForm extends Model
{
    private $_bill;
    private $_positions;
    private $_customers;

    public function rules()
    {
        return [
            [['Bill'], 'required'],
            [['Positions'], 'safe'],      
            //[['customer_id'], 'required'],
            //[['status', 'customer_id', 'price', 'description'], 'required'],
            //[['customer_id', 'created_at', 'updated_at'], 'integer'],
            //[[], 'string'],
            //[['price', 'status'], 'number'],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
           
            //['price', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
            //['quantity', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
            //['tax', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
        
        ];
    }

    public function afterValidate()
    {
        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->bill->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->savePositions()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function savePositions() 
    {
        $keep = [];
        foreach ($this->positions as $position) {
            $position->bill_id = $this->bill->id;
            if (!$position->save(false)) {
                return false;
            }
            $keep[] = $position->id;
        }
        $query = Position::find()->andWhere(['bill_id' => $this->bill->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $position) {
            $position->delete();
        }        
        return true;
    }
    
    public function savePositionsId($id) 
    {
        $keep = [];
        foreach ($this->positions as $position) {
            $position->bill_id = $id;
            if (!$position->save(false)) {
                return false;
            }
            $keep[] = $position->id;
        }
        $query = Position::find()->andWhere(['bill_id' => $id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $position) {
            $position->delete();
        }        
        return true;
    }

    public function getBill()
    {
        return $this->_bill;
    }

    public function setBill($bill)
    {
        if ($bill instanceof Bill) {
            $this->_bill = $bill;
        } else if (is_array($bill)) {
            $this->_bill->setAttributes($bill);
        }
    }

    public function getPositions()
    {
        if ($this->_positions === null) {
            $this->_positions = $this->bill->isNewRecord ? [] : $this->bill->positions;
        }
        return $this->_positions;
    }

    private function getPosition($key)
    {
        $position = $key && strpos($key, 'new') === false ? Position::findOne($key) : false;
        if (!$position) {
            $position = new Position();
            $position->loadDefaultValues();
        }
        return $position;
    }

    public function setPositions($positions)
    {
        unset($positions['__id__']); // remove the hidden "new Position" row
        $this->_positions = [];
        foreach ($positions as $key => $position) {
            if (is_array($position)) {
                $this->_positions[$key] = $this->getPosition($key);
                $this->_positions[$key]->setAttributes($position);
            } elseif ($position instanceof Position) {
                $this->_positions[$position->id] = $position;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
              // 'header' => '<p>Please fix the following errors for: <b>' . $id . '</b></p>',
              //'header' => '<p>'.Yii::t('app', 'Please fix the following errors for:').' <b> ' . $id . '</b></p>',
              'header' => '<p>'.Yii::t('app', 'Please fix the following errors:').'</p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [
            'Bill' => $this->bill,            
        ];
        foreach ($this->positions as $id => $position) {
            $models['Position.' . $id] = $this->positions[$id];
        }
        return $models;
    }
    
    
}

