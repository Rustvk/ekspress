<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "advert".
 *
 * @property integer $advert_id
 * @property string $text
 * @property integer $public
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public'], 'integer'],
            [['text'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advert_id' => 'Advert ID',
            'text' => 'Текст объявления',
            'public' => 'Опубликовано',
        ];
    }
}
