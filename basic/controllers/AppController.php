<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Company;		// Модель Company отвечает за подключение к таблице информации о компании в бд
use yii\caching\DbDependency;


class AppController extends Controller{

	protected function setMeta($title = null, $keywords = null, $description = null)
	{
		$this->view->title = $title;
		$this->view->registerMetaTag(['name'=>'keywords', 'content' => "$keywords"]);
		$this->view->registerMetaTag(['name'=>'description', 'content' => "$description"]);
	}

	protected function getCompany() {
		$dependency = new DbDependency([
		    'sql' => 'SELECT MAX(updated_at) FROM company',
		]);

		$company = Yii::$app->db->cache(function ($db) {
		    return Company::findOne(Yii::$app->params['company_id']);
		}, 0, $dependency);
		return $company;
	}
} 

