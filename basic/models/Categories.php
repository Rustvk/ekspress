<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Categories extends ActiveRecord{
	public static function tableName() {
			return 'categories';
	}
	// Если связь была бы многие ко многим то связь описывалась бы через Viatable (промежуточную таблицу)
	// public function getProducts() {
	//     return $this->hasMany(Product::className(), ['id' => 'product_id'])
	//       ->viaTable('product_categories', ['category_id' => 'id']);
	// }

	// Мы используем связь один ко многим. Т.е. данный код описывает что категория может содержать много продуктов.
	// В модели Product указано что продукт может содержаться только в одной категории
	public function getProduct(){
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }	
}