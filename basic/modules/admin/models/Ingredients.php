<?php

namespace app\modules\admin\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property integer $id
 * @property string $name
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    public static function getAvailableIngredients()
    {
        $ingredients = self::find()->orderBy('name')->asArray()->all();
        $items = ArrayHelper::map($ingredients, 'id', 'name');
        return $items;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }
}
