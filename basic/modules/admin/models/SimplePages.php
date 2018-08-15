<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "simple_pages".
 *
 * @property integer $id
 * @property integer $public
 * @property string $name
 * @property string $content
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 */
class SimplePages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'simple_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public'], 'integer'],
            [['content'], 'string'],
            [['name', 'meta_key', 'meta_title', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'public' => 'Опубликовано',
            'name' => 'Название',
            'content' => 'Контент',
            'meta_key' => 'Ключевые слова',
            'meta_title' => 'Мета заголовок',
            'meta_description' => 'Мета Описание',
        ];
    }
}
