<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property string $short_description
 * @property integer $public
 * @property integer $date
 * @property string $name
 * @property string $description
 * @property string $salary
 * @property integer $meta_title
 * @property integer $meta_key
 * @property integer $meta_desc
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public'], 'integer'],
            [['short_description', 'date', 'name', 'salary', 'meta_title', 'meta_key', 'meta_desc'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 3000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_description' => 'Краткое описание',
            'public' => 'Опубликовано',
            'date' => 'Дата',
            'name' => 'Название',
            'description' => 'Полное описание',
            'salary' => 'Зарплата',
            'meta_title' => 'Meta Title',
            'meta_key' => 'Ключевые слова',
            'meta_desc' => 'Мета описание',
        ];
    }
}
