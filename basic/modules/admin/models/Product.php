<?php

namespace app\modules\admin\models;
// use Imagine\Gd;

use yii\imagine\Image;
use yii\imagine\Imagick;
use Imagine\Image\Box;
use Yii;
use Imagine;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $ingredients
 * @property string $public
 * @property string $image
 * @property integer $price
 * @property string $weight
 * @property integer $popular
 * @property string $meta_key
 * @property integer $order
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $child
 */
class Product extends \yii\db\ActiveRecord
{

    public $img;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }
 
    public function getCategory(){
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }    
    public function getSubProducts() {
        return $this->hasMany(Product::className(), ['parent_id' => 'id'])->where(['public'=>1]);
    }
    public function getIngredients(){
        return $this->hasMany(Ingredients::className(), ['id' => 'ingredient_id'])
          ->viaTable('product_ingredients', ['product_id' => 'id']);
    }
    public function getParentProduct() {
        return $this->hasOne(Product::className(), ['id' => 'parent_id']);
    }

    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => \voskobovich\linker\LinkerBehavior::className(),
    //             'relations' => [
    //                 'ingredients_ids' => 'ingredients',
    //             ],
    //         ],
    //     ];
    // }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['public', 'popular', 'child'], 'integer'],
            [['price', 'order', 'category_id', 'parent_id'], 'integer'],
            [['name', 'description', 'weight', 'meta_key'], 'string', 'max' => 255],
            // [['name', 'description', 'weight', 'meta_key'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions'=>'png, jpg'],

        ];
    }
    // public static function getAvailableIngredients()
    // {
    //     $daughters = self::find()->orderBy('name')->asArray()->all();
    //     $items = ArrayHelper::map($products, 'id', 'name');
    //     return $items;
    // }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'public' => 'Опубликовано',
            'image' => 'Изображение',
            'img' => 'Изображение',
            'ingredients' => 'Ингредиенты',
            'price' => 'Цена (Руб.)',
            'weight' => 'Вес',
            'popular' => 'Популярное',
            'meta_key' => 'Ключевые слова',
            'order' => 'Порядок',
            'category_id' => 'Категория',
            'parent_id' => 'Родитель',
            'child' => 'Детское меню',
        ];
    }

    public function makeWatermark($newname, $image, $imsize, $sizes) {
            $imagine = Image::getImagine();

            $this        ->resizeBy($image, $sizes, 0)->save(Yii::getAlias('@webroot/images/products/'.$sizes.'/'.$newname), ['quality' => 80]);
            $reimage     = $imagine->open(Yii::getAlias('@webroot/images/products/'.$sizes.'/'.$newname));
            $size        = $reimage->getSize();

            $watermark   = $imagine->open(Yii::getAlias('@webroot/images/watermark.png'));
            $watermarkSize       = $watermark->getSize();

            if (($watermarkSize->getHeight())>$imsize->getHeight()) {
                $this->resizeBy($watermark, 0, $size->getHeight())->save(Yii::getAlias('@webroot/images/watermark/watermark2.png'), ['quality' => 80]);
            } else { 
                $this->resizeBy($watermark, $size->getWidth(), 0)->save(Yii::getAlias('@webroot/images/watermark/watermark2.png'), ['quality' => 80]);
            }            
            $water = $imagine->open(Yii::getAlias('@webroot/images/watermark/watermark2.png'));
            $wSize = $water->getSize();

            $center = new Imagine\Image\Point(($size->getWidth() - $wSize->getWidth())/2, ($size->getHeight() - $wSize->getHeight())/2);                
            $reimage->paste($water, $center)->save(Yii::getAlias('@webroot/images/products/'.$sizes.'/'.$newname), ['quality' => 80]);
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
    public function upload() {

        if ($this->validate()) {
            $imagine = Image::getImagine();
            $newname = rus2translit($this->name).'_'.$this->id.'.'.$this->img->extension;
            $path = 'images/products/upload/'.$newname;
            $this->img->saveAs($path);
            $image = $imagine->open(Yii::getAlias('@webroot/images/products/upload/'.$newname));
            $this->resizeBy($image, 1500, 0)->save(Yii::getAlias('@webroot/images/products/upload/'.$newname));
            $imsize = $image->getSize();
            $this->makeWatermark($newname,$image,$imsize,1500);
            $this->makeWatermark($newname,$image,$imsize,600);
            $this->makeWatermark($newname,$image,$imsize,266);
            @unlink(Yii::getAlias('@webroot/images/watermark/watermark2.png'));
            @unlink(Yii::getAlias('@webroot/images/products/upload/'.$newname));
            // $model = new Product;
            $this['image'] = $newname;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
    public function deleteImages() {
        if ((file_exists(Yii::getAlias('@webroot/images/products/1500/'.$this->image))||file_exists(Yii::getAlias('@webroot/images/products/600/'.$this->image))||file_exists(Yii::getAlias('@webroot/images/products/266/'.$this->image)))&&($this->image!='no-image.jpg')) {
            @unlink(Yii::getAlias('@webroot/images/products/1500/'.$this->image));
            @unlink(Yii::getAlias('@webroot/images/products/600/'.$this->image));
            @unlink(Yii::getAlias('@webroot/images/products/266/'.$this->image));
        }
        $this['image'] = "no-image.jpg";
        $this->save();
        // print_r($this->getErrors());
    }

}