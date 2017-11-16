<?php
namespace frontend\models\form;

use frontend\models\Offer;
use frontend\models\Part;
use frontend\models\Customer;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class OfferForm extends Model
{
    private $_offer;
    private $_parts;
    private $_customers;

    public function rules()
    {
        return [
            [['Offer'], 'required'],
            [['Parts'], 'safe'],      
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
        if (!$this->offer->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveParts()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function saveParts() 
    {
        $keep = [];
        foreach ($this->parts as $part) {
            $part->offer_id = $this->offer->id;
            if (!$part->save(false)) {
                return false;
            }
            $keep[] = $part->id;
        }
        $query = Part::find()->andWhere(['offer_id' => $this->offer->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $part) {
            $part->delete();
        }        
        return true;
    }

    public function getOffer()
    {
        return $this->_offer;
    }

    public function setOffer($offer)
    {
        if ($offer instanceof Offer) {
            $this->_offer = $offer;
        } else if (is_array($offer)) {
            $this->_offer->setAttributes($offer);
        }
    }

    public function getParts()
    {
        if ($this->_parts === null) {
            $this->_parts = $this->offer->isNewRecord ? [] : $this->offer->parts;
        }
        return $this->_parts;
    }

    private function getPart($key)
    {
        $part = $key && strpos($key, 'new') === false ? Part::findOne($key) : false;
        if (!$part) {
            $part = new Part();
            $part->loadDefaultValues();
        }
        return $part;
    }

    public function setParts($parts)
    {
        unset($parts['__id__']); // remove the hidden "new Position" row
        $this->_parts = [];
        foreach ($parts as $key => $part) {
            if (is_array($part)) {
                $this->_parts[$key] = $this->getPart($key);
                $this->_parts[$key]->setAttributes($part);
            } elseif ($part instanceof Part) {
                $this->_parts[$part->id] = $part;
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
            'Offer' => $this->offer,            
        ];
        foreach ($this->parts as $id => $part) {
            $models['Part.' . $id] = $this->parts[$id];
        }
        return $models;
    }
    
    
}

