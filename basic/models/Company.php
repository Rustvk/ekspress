<?php 

namespace app\models;
use yii\db\ActiveRecord;

class Company extends ActiveRecord
{
		// public function getCompanyInfo() {

		// // Cчитываем информацию о компании из кеша если она есть
		// $company_info = Yii::$app->cache->get('company_info');
		// if ($company_info) return $company_info;
		// else {
		// 	return $company = Company::findOne(Yii::$app->params['company_id']);
		// 	//Записываем информацию в кеш, если она в кеше отсутствует, запись на 60 секунд
		// 	Yii::$app->cache->set('company_info', $company, 60); //change
		// 	}	
		// }
		


}
