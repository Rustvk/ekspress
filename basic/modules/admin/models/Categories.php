<?php

namespace app\modules\admin\models;

use yii\imagine\Image;
use yii\imagine\Imagick;
use Imagine\Image\Box;
use Yii;
use Imagine;
/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_key
 * @property string $meta_desc
 * @property integer $parent_id
 * @property integer $public
 * @property integer $order_num
 * @property string $class
 * @property string $image
 * @property string $back_image
 * @property string $public_in_menu
 * @property string $public_in_cat
 */
class Categories extends \yii\db\ActiveRecord
{
    public $img;
    public $back_img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }
    public function getCategory(){
        return $this->hasOne(Categories::className(), ['id' => 'parent_id']);
    } 
    public function getParCategory(){
        return $this->hasMany(Categories::className(), ['parent_id' => 'id']);
    } 
    public function getProduct(){
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public static function getAvailableItems()
    {
        $categories = self::find()
        ->joinWith([
            'product' => function ($query) {
                $query->onCondition(['product.parent_id' => 0])->with('subProducts');
            },
        ])
        ->where(['not', ['categories.id' => ['7', '11']]])
        ->andWhere(['categories.parent_id' => 0])
        // ->with('parCategory')
        ->all();

        // $products = self::find()->with('subProducts')->with('category')->orderBy('category_id')->all();
        // $items = ArrayHelper::map($products, 'id', 'name');
        return $categories;
    }    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'order_num'], 'integer'],
            [['public_in_menu', 'public_in_cat', 'public'], 'integer'],
            [['name', 'description', 'meta_key', 'class', 'image', 'back_image'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions'=>'png, jpg'],
            [['back_image'], 'file', 'extensions'=>'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'meta_key' => 'Ключевые слова',
            'parent_id' => 'Родительская категория',
            'public' => 'Опубликовано',
            'order_num' => 'Порядок',
            'class' => 'Класс категории',
            'image' => 'Малое изображение',
            'img' => 'Малое изображение',
            'back_image' => 'Фоновое изображение',
            'back_img' => 'Фоновое изображение',
            'public_in_menu' => 'Публикация в меню',
            'public_in_cat' => 'Публикация в списке категорий',
        ];
    }

    function resizeBy($image, $width, $height) {
        if ($height==0) {
            $ratio = $image->getSize()->getWidth()/$width;
            $image->resize(new Box($width, $image->getSize()->getHeight()/$ratio));
            return $image;
        } elseif ($width==0) {
            $ratio = $image->getSize()->getHeight()/$height;
            $image->resize(new Box($image->getSize()->getWidth()/$ratio, $height));
            return $image;
        }
    }    
    public function uploadImage() {
        if ($this->validate()) {
            $imagine = Image::getImagine();
            $newname = rus2translit($this->name).'_'.$this->id.'.'.$this->img->extension;
            $path = 'images/categories/upload/'.$newname;
            $this->img->saveAs($path);
            $image = $imagine->open(Yii::getAlias('@webroot/images/categories/upload/'.$newname));
            $this->resizeBy($image, 266, 0)->save(Yii::getAlias('@webroot/images/categories/266/'.$newname));

            @unlink(Yii::getAlias('@webroot/images/categories/upload/'.$newname));
            $this['image'] = $newname;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
    public function uploadBackimage() {
        if ($this->validate()) {
            $imagine = Image::getImagine();
            $newname = rus2translit($this->name).'_'.$this->id.'.'.$this->back_img->extension;
            $path = 'images/categories/upload/'.$newname;
            $this->back_img->saveAs($path);
            $image = $imagine->open(Yii::getAlias('@webroot/images/categories/upload/'.$newname));
            $this->resizeBy($image, 1500, 0)->crop(new Imagine\Image\Point(0, 0), new Box(1500, 200))->save(Yii::getAlias('@webroot/images/categories/1500/'.$newname));

            @unlink(Yii::getAlias('@webroot/images/categories/upload/'.$newname));
            $this['back_image'] = $newname;
            $this->save();
            return true;
        } else {
            return false;
        }        
    }
    public function deleteImages($image) {
        // debug($image);
        // die;
        if ($image=='image') {
            $delimg = $this->image;
            $this['image'] = "no-image.jpg";
            if ((file_exists(Yii::getAlias('@webroot/images/categories/266/'.$delimg)))&&($delimg!='no-image.jpg')) {
                @unlink(Yii::getAlias('@webroot/images/categories/266/'.$delimg));
            }
        } else {
            $delimg = $this->back_image;
            $this['back_image'] = "back_image.jpg";
            if ((file_exists(Yii::getAlias('@webroot/images/categories/1500/'.$delimg)))&&($delimg!='back_image.jpg')) {        
                @unlink(Yii::getAlias('@webroot/images/categories/1500/'.$delimg));
            }
        }
        $this->save();
        // print_r($this->getErrors());
    }


}
