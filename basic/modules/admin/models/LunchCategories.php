<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "lunch_categories".
 *
 * @property integer $id
 * @property integer $order
 * @property string $name
 * @property string $description
 * @property integer $public
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
    public function getLunchProducts(){
        return $this->hasMany(LunchProducts::className(), ['lunch_category_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'public'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
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
