<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $qty
 * @property string $summ
 */

class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $verifyCode;

    public static function tableName()
    {
        return 'order';
    }
    public function behaviors() {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['new'],
                ],
                'value' => 1,
            ],            
        ];
    }

    public static function getOrderItems() {
        return $this->hasMany(OrderItems::className(), ['order_id'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['qty', 'new'], 'integer'],
            ['email', 'email'],
            [['name', 'phone', 'email', 'message'], 'string', 'max' => 255],
            ['verifyCode', 'captcha'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя *',
            'phone' => 'Телефон *',
            'email' => 'Email',
            'message' => 'Сообщение',
            'verifyCode' => 'Пожалуйста, введите проверочный код *',
        ];
    }
}
