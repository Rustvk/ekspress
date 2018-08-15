<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{
	public static function tableName() {
			return 'product';
	}

	public function getCategory(){
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
    public function getConsist(){
	    return $this->hasMany(Ingredients::className(), ['id' => 'ingredient_id'])
	      ->viaTable('product_ingredients', ['product_id' => 'id']);
	}
	public function getSubProducts() {
		return $this->hasMany(Product::className(), ['parent_id' => 'id'])->where(['public'=>1]);
	}
	public function getParentProduct() {
		return $this->hasOne(Product::className(), ['id' => 'parent_id'])->where(['public'=>1]);
	}	
}