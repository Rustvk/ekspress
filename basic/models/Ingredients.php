<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Ingredients extends ActiveRecord{
	public static function tableName() {
			return 'ingredients';
	}
	public function getProduct() {
	    return $this->hasMany(Ingredients::className(), ['id' => 'ingredient_id'])
	      ->viaTable('product_ingredients', ['product_id' => 'id']);
	}
}