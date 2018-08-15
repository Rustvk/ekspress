<?php

namespace app\components;
use yii\base\Widget;
use app\models\Company;
use Yii;

class CompanyWidget extends Widget{
	public $object;

	public function init() {
			parent::init();
	}

	public function run() {
		$company = Company::getDb()->cache(function ($db) {
   			return Company::findOne(Yii::$app->params['company_id']);;
		}, 60); //change
		if (($this->object)=='desc') {
		return $company->description;
		}
		if (($this->object)=='phone') {
		return $company->phone;
		}
		if (($this->object)=='adress') {
		return $company->adress;
		}
		if (($this->object)=='mail') {
		return $company->mail;
		}
		if (($this->object)=='name') {
		return $company->name;
		}		
	}

}

