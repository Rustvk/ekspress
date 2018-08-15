<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $company_id
 * @property string $name
 * @property string $phone
 * @property string $mail
 * @property string $work_hours
 * @property string $description
 * @property integer $public
 * @property string $adress
 * @property string $image
 * @property string $logo
 * @property string $mobile_phone
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public'], 'integer'],
            [['name', 'mail', 'description', 'image', 'logo'], 'string', 'max' => 255],
            [['phone', 'mobile_phone'], 'string', 'max' => 50],
            [['adress', 'work_hours'], 'string', 'max' => 500],
            [['requisites'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'name' => 'Название',
            'phone' => 'Телефон',
            'mail' => 'Электронный адрес',
            'work_hours' => 'Режим работы',
            'description' => 'Описание',
            'public' => 'Опубликовано',
            'adress' => 'Адрес',
            'image' => 'Image',
            'logo' => 'Logo',
            'requisites' => 'Реквизиты',
            'mobile_phone' => 'Мобильный телефон',
        ];
    }
}
