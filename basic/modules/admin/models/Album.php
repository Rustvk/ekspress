<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $description
 * @property string $meta_key
 * @property integer $public
 */
class Album extends \yii\db\ActiveRecord
{

    public $image;
    public $gallery;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    } 


    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public'], 'integer'],
            [['name', 'description', 'meta_key'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Изображение альбома',
            'gallery' => 'Фотографии в альбоме',
            'name' => 'Название',
            'description' => 'Описание',
            'meta_key' => 'Ключевые слова',
            'public' => 'Опубликовано',
        ];
    }
    public function upload(){
        if($this->validate()){
            $path = 'images/gallery/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery(){
        if($this->validate()){
            foreach($this->gallery as $file){
                $path = 'images/gallery/'. $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }    
}
