<?php

namespace app\modules\admin\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

use Yii;

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
 * @property string $status
 * @property string $to_date
 * @property string $type
 */
class Order extends \yii\db\ActiveRecord
{
    var $products_ids = [];
    var $text;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }
    public function getOrderItems() {
        return $this->hasMany(OrderItems::className(), ['order_id'=>'id']);
    }

    public function behaviors() {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['status'],
                ],
                'value' => 1,
            ],           
        ];
    }    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'to_date'], 'safe'],
            [['type'], 'string'],
            [['new', 'status'], 'integer'],
            [['name', 'phone', 'email', 'qty', 'summ'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 3000],
        ];
    }
    /**
     * load the post's categories (*2)
     */
    public function loadItems()
    {
        $this->products_ids = [];
        if (!empty($this->id)) {
            $rows = OrderItems::find()
                ->select('product_id, text, price')
                ->where(['order_id' => $this->id])
                ->asArray()
                ->all();
            // $i=0;
            foreach($rows as $row) {
               // $this->products_ids[$i] = $row['product_id'];
               $this->products_ids[$row['product_id']]['text'] = $row['text'];
               $this->products_ids[$row['product_id']]['price'] = $row['price'];
               // $i ++;
            }
        }
    }
 
    public function deleteItems() {
        OrderItems::deleteAll(['order_id' => $this->id]);
    }

    
    public function saveItems($products)
    {
        /* clear the categories of the post before saving */
        OrderItems::deleteAll(['order_id' => $this->id]);
        if (is_array($products)) {
            foreach($products as $product) {   
                // debug($product_id);
                $pi = new OrderItems;
                // debug($this->id);
                $pi->order_id = $this->id;
                $pi->product_id = $product['id'];                
                $pi->text = $product['text'];                
                $pi->name = $product['name'];                
                $pi->price = $product['price'];                
                $pi->save();           
            }
        }
        return true;
        /* Be careful, $this->ingredients_ids can be empty */
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'message' => 'Комментарий',
            'qty' => 'Количество блюд',
            'summ' => 'Сумма',
            'status' => 'Статус',
            'new' => 'Вид',
            'to_date' => 'Дата выполнения',
            'type' => 'Тип заказа',
        ];
    }
}
