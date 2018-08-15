<?php 
namespace app\modules\admin\models;
use yii\helpers\ArrayHelper;



class DaughterProducts extends ProductWithIngredients
{
    var $daughter_ids = [];
 
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['public'], 'integer'],
            [['price', 'order', 'parent_id'], 'integer'],
            [['name', 'weight'], 'string', 'max' => 255],
        ];
    }
 
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'daughter_ids' => 'Daughters',
        ]);
    }
 
    /**
     * load the post's categories (*2)
     */
    public function loadDaughters()
    {
        $this->daughter_ids = [];
        if (!empty($this->id)) {
            $rows = Product::find()
                ->select(['id'])
                ->where(['parent_id' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->daughter_ids[] = $row['id'];
            }
        }
    }
 
    /**
     * save the post's categories (*3)
     */
    public function deleteDaughter() {
        Product::deleteAll(['parent_id' => $this->id]);
    }

    
    public function saveDaughters()
    {
        /* clear the categories of the post before saving */
        Product::deleteAll(['product_id' => $this->id]);
        if (is_array($this->daughter_ids)) {
            foreach($this->daughter_ids as $daughter_id) {   
                // debug($ingredient_id);
                $pi = new Product;
                // debug($this->id);
                $pi->parent_id = $this->id;
                $pi->save();               
            }
        }
        /* Be careful, $this->ingredients_ids can be empty */
    }
}

?>