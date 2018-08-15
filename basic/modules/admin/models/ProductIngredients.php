<?php

namespace app\modules\admin\models;
use Yii;

/**
 * This is the model class for table "product_ingredients".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $ingredient_id
 */
class ProductIngredients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_ingredients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'ingredient_id'], 'required'],
            [['product_id', 'ingredient_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'ingredient_id' => 'Ingredient ID',
        ];
    }
}
