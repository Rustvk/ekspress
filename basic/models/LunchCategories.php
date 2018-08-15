<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lunch_categories".
 *
 * @property integer $id
 * @property integer $order
 * @property string $name
 * @property string $description
 * @property string $public
 */
class LunchCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lunch_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order'], 'integer'],
            [['public'], 'string'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }
    public function getLunchProducts(){
        return $this->hasMany(LunchProducts::className(), ['lunch_category_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Порядок',
            'name' => 'Название',
            'description' => 'Описание',
            'public' => 'Опубликовано',
        ];
    }
}
