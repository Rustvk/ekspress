<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lunch_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $photo
 * @property integer $lucnh_category_id
 * @property string $public
 */
class LunchProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lunch_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lucnh_category_id'], 'integer'],
            [['public'], 'string'],
            [['name', 'description', 'photo'], 'string', 'max' => 255],
        ];
    }

    public function getLunchCategory(){
        return $this->hasOne(LunchCategories::className(), ['id' => 'lunch_category_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Description',
            'photo' => 'Photo',
            'lucnh_category_id' => 'Lucnh Category ID',
            'public' => 'Public',
        ];
    }
}
