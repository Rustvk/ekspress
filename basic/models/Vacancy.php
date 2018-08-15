<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Vacancy extends ActiveRecord{
	public static function tableName() {
			return 'vacancy';
	}
}