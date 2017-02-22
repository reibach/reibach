<?php
namespace backend\models\form;

use backend\models\Mandator;
use backend\models\Article;
use backend\models\Address;
use backend\models\User;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class MandatorForm extends Model
{
    private $_mandator;
    private $_address;
    private $_article;
    private $_articles;
    private $_user;

    public function rules()
    {
        return [
            [['Mandator'], 'required'],
            [['Articles'], 'safe'],      
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['price', 'status'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

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
        if (!$this->mandator->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveArticles()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function saveArticles() 
    {
        $keep = [];
        foreach ($this->articles as $article) {
            $article->mandator_id = $this->mandator->id;
            if (!$article->save(false)) {
                return false;
            }
            $keep[] = $article->id;
        }
        $query = Article::find()->andWhere(['mandator_id' => $this->mandator->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $article) {
            $article->delete();
        }        
        return true;
    }

    public function saveAddress() 
    {
        $keep = [];
        foreach ($this->articles as $article) {
            $article->mandator_id = $this->mandator->id;
            if (!$article->save(false)) {
                return false;
            }
            $keep[] = $article->id;
        }
        $query = Article::find()->andWhere(['mandator_id' => $this->mandator->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $article) {
            $article->delete();
        }        
        return true;
    }

    public function getMandator()
    {
        return $this->_mandator;
    }

    public function setMandator($mandator)
    {
        if ($mandator instanceof Mandator) {
            $this->_mandator = $mandator;
        } else if (is_array($mandator)) {
            $this->_mandator->setAttributes($mandator);
        }
    }

    public function getArticles()
    {
        if ($this->_articles === null) {
            $this->_articles = $this->mandator->isNewRecord ? [] : $this->mandator->articles;
        }
        return $this->_articles;
    }

    private function getArticle($key)
    {
        $article = $key && strpos($key, 'new') === false ? Article::findOne($key) : false;
        if (!$article) {
            $article = new Article();
            $article->loadDefaultValues();
        }
        return $article;
    }

    public function setArticles($articles)
    {
        unset($articles['__id__']); // remove the hidden "new Article" row
        $this->_articles = [];
        foreach ($articles as $key => $article) {
            if (is_array($article)) {
                $this->_articles[$key] = $this->getArticle($key);
                $this->_articles[$key]->setAttributes($article);
            } elseif ($article instanceof Article) {
                $this->_articles[$article->id] = $article;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
              'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [
            'Mandator' => $this->mandator,            
        ];
        foreach ($this->articles as $id => $article) {
            $models['Article.' . $id] = $this->articles[$id];
        }
        return $models;
    }
    
    
}

