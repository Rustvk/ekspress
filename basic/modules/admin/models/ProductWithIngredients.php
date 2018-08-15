<?php 
namespace app\modules\admin\models;
use yii\helpers\ArrayHelper;



class ProductWithIngredients extends Product
{
    var $ingredients_ids = [];
 
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // each category_id must exist in category table (*1)
            ['ingredients_ids', 'each', 'rule' => [
                    'exist', 'targetClass' => Ingredients::className(), 'targetAttribute' => 'id'
                ]
            ],
        ]);
    }
 
    public function getDaughterProducts() {
        return $this->hasMany(Product::className(), ['parent_id' => 'id']);
    }  
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'ingredients_ids' => 'Ingredients',
        ]);
    }
 
    /**
     * load the post's categories (*2)
     */
    public function loadIngredients()
    {
        $this->ingredients_ids = [];
        if (!empty($this->id)) {
            $rows = ProductIngredients::find()
                ->select(['ingredient_id'])
                ->where(['product_id' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->ingredients_ids[] = $row['ingredient_id'];
            }
        }
    }
 
    /**
     * save the post's categories (*3)
     */
    public function deleteIngredients() {
        ProductIngredients::deleteAll(['product_id' => $this->id]);
    }

    
    public function saveIngredients()
    {
        /* clear the categories of the post before saving */
        ProductIngredients::deleteAll(['product_id' => $this->id]);
        if (is_array($this->ingredients_ids)) {
            foreach($this->ingredients_ids as $ingredient_id) {   
                // debug($ingredient_id);
                $pi = new ProductIngredients;
                // debug($this->id);
                $pi->product_id = $this->id;
                $pi->ingredient_id = $ingredient_id;                
                $pi->save();               
            }
        }
        /* Be careful, $this->ingredients_ids can be empty */
    }
}

?>