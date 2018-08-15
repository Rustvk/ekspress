<?php

namespace app\modules\admin\models;

use Yii;
use yii\imagine\Image;
use yii\imagine\Imagick;
use Imagine\Image\Box;
use Imagine;

/**
 * This is the model class for table "lunch_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $lunch_category_id
 * @property integer $order
 * @property integer $public
 * @property string $price
 * @property string $weight
 */
class LunchProducts extends \yii\db\ActiveRecord
{
    public $img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lunch_products';
    }
    public function getLunchCategory(){
        return $this->hasOne(LunchCategories::className(), ['id' => 'lunch_category_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lunch_category_id', 'order', 'public'], 'integer'],
            [['name', 'description', 'image'], 'string', 'max' => 255],
            [['price', 'weight'], 'string', 'max' => 50],
            [['image'], 'file', 'extensions'=>'png, jpg'],

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
            'image' => 'Изображение',
            'img' => 'Изображение',
            'lunch_category_id' => 'Категория',
            'order' => 'Порядок',
            'public' => 'Опубликовано',
            'price' => 'Цена (Руб.)',
            'weight' => 'Вес',
        ];
    }




    public function makeWatermark($newname, $image, $imsize, $sizes) {
            $imagine = Image::getImagine();

            $this        ->resizeBy($image, $sizes, 0)->save(Yii::getAlias('@webroot/images/lunchproducts/'.$sizes.'/'.$newname), ['quality' => 80]);
            $reimage     = $imagine->open(Yii::getAlias('@webroot/images/lunchproducts/'.$sizes.'/'.$newname));
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
            $reimage->paste($water, $center)->save(Yii::getAlias('@webroot/images/lunchproducts/'.$sizes.'/'.$newname), ['quality' => 80]);
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
            $path = 'images/lunchproducts/upload/'.$newname;
            $this->img->saveAs($path);
            $image = $imagine->open(Yii::getAlias('@webroot/images/lunchproducts/upload/'.$newname));
            $this->resizeBy($image, 1500, 0)->save(Yii::getAlias('@webroot/images/lunchproducts/upload/'.$newname));
            $imsize = $image->getSize();
            $this->makeWatermark($newname,$image,$imsize,1500);
            $this->makeWatermark($newname,$image,$imsize,600);
            $this->resizeBy($image, 266, 0)->save(Yii::getAlias('@webroot/images/lunchproducts/266/'.$newname), ['quality' => 80]);
            // $this->makeWatermark($newname,$image,$imsize,266);

            @unlink(Yii::getAlias('@webroot/images/watermark/watermark2.png'));
            @unlink(Yii::getAlias('@webroot/images/lunchproducts/upload/'.$newname));
            // $model = new Product;
            $this['image'] = $newname;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
    public function deleteImages() {
        if ((file_exists(Yii::getAlias('@webroot/images/lunchproducts/1500/'.$this->image))||file_exists(Yii::getAlias('@webroot/images/lunchproducts/600/'.$this->image))||file_exists(Yii::getAlias('@webroot/images/lunchproducts/266/'.$this->image)))&&($this->image!='no-image.jpg')) {
            @unlink(Yii::getAlias('@webroot/images/lunchproducts/1500/'.$this->image));
            @unlink(Yii::getAlias('@webroot/images/lunchproducts/600/'.$this->image));
            @unlink(Yii::getAlias('@webroot/images/lunchproducts/266/'.$this->image));
        }
        $this['image'] = "no-image.jpg";
        $this->save();
        // print_r($this->getErrors());
    }
 
}
