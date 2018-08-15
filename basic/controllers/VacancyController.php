<?php

namespace app\controllers;
use Yii;
use app\models\Vacancy;
use yii\caching\DbDependency;


class VacancyController extends AppController {
		// public function filters()
  //   {
  //       return array(
  //           array(
  //               'COutputCache',
  //               'duration'=> 3600,
		// 		'varyByParam'=>array('id'),
  //           ),
  //       );
  //   }
	public function actionIndex() {
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM vacancy',
        ]);
        $vacancy = Yii::$app->db->cache(function ($db) {
            return Vacancy::find()->where(['public'=>1])->all();
        }, 0, $dependency);

		$company = $this->getCompany();

		$this->setMeta('Вакансии '.$company->name,'', 'Вакансии '.$company->name.', трудоустройство в Плешаново, Красногвардейский район');
		return $this->render('index', compact('vacancy', 'company'));
	}
	public function actionView($id) {

        $vacation = Vacancy::find()->where(['public'=>1])->andWhere(['id'=>$id])->one();
		if (empty($vacation)) throw new \yii\web\HttpException(404, 'К сожалению такой вакансии не найдено.');

		$company = $this->getCompany();
		$this->setMeta('Вакансии '.$company->name.', ' .$vacation->name,'', 'Вакансии '.$company->name.', трудоустройство в Плешаново, Красногвардейский район');
		return $this->render('view', compact('vacation', 'company'));	
	}	
}