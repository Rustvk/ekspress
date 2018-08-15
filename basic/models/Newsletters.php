<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newsletters".
 *
 * @property integer $news_id
 * @property string $email
 */
class Newsletters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'email' => 'Email',
        ];
    }
}
