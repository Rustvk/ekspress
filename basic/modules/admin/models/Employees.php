<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $adress
 * @property string $description
 * @property string $start
 * @property string $end
 * @property string $birthday
 * @property string $zadiak
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end', 'birthday'], 'safe'],
            [['name', 'email', 'zadiak'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['adress'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'adress' => 'Адрес',
            'description' => 'Описание',
            'start' => 'Дата приема на работу',
            'end' => 'Дата увольнения',
            'birthday' => 'День рождения',
            'zadiak' => 'Знак зодиака',
        ];
    }
}
