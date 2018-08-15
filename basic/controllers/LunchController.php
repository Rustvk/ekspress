<?php

namespace app\controllers;
use app\models\LunchCategories;
use app\models\LunchProducts;
use Yii;
use yii\caching\DbDependency; // Класс для определения зависимостей кеширования БД


class LunchController extends AppController {
    public function filters()
    {
        return array(
            array(
                'COutputCache',
                'duration'=> 3600,
                'varyByParam'=>array('id'),
            ),
        );
    }
    public function actionIndex()
    {
        $company = $this->getCompany();

		$this->setMeta('Обеденное меню '.$company->name, '', 'Обеды в'.$company->name);
		// $cat_products = LunchCategories::find()->joinWith('lunchProducts')->where(['lunch_categories.public'=>1])->andWhere(['lunch_products.public'=>1])->orderBy(['lunch_categories.order' => SORT_ASC])->all();
      
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(mx) FROM (SELECT MAX(updated_at) as mx FROM lunch_categories UNION SELECT MAX(updated_at) as mx FROM lunch_products) s',
        ]);

        $cat_products = Yii::$app->db->cache(function ($db) {
            return LunchCategories::find()
            ->joinWith([
            'lunchProducts' => function ($query) {
                $query->onCondition(['lunch_products.public' => 1]);
            },
            ])
            ->where(['lunch_categories.public' => 1])
            ->andWhere(['lunch_categories.id' => ['1', '2', '3']])
            ->orderBy(['lunch_categories.order' => SORT_ASC, 'lunch_products.order'=>SORT_ASC])
            ->all();
        }, 0, $dependency);


        $dependency_cat = new DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM lunch_categories',
        ]);
        $categories = Yii::$app->db->cache(function ($db) {
            return LunchCategories::find()->where(['public'=>1])->orderBy(['order'=>SORT_ASC])->all();
        }, 0, $dependency_cat);

        return $this->render('index', compact('cat_products', 'categories'));
    }

}
