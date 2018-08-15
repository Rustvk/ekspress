<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Album extends ActiveRecord{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
	public static function tableName() {
			return 'album';
	}
	
	public function getPhotos(){
        return $this->hasMany(Photos::className(), ['album_id' => 'id']);
    }	

}