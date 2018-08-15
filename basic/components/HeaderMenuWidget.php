<?php

namespace app\components;
use yii\base\Widget;
use app\models\Categories;
use Yii;


class HeaderMenuWidget extends Widget {

	public $data; /* Записи категорий из БД */
	public $tree; /* Результат работы функции - из массива строится дерево со вложенностью */
	public $menuHtml; /* Готовый HTML код в зависимости от шаблона */


	public function init() {
		parent::init();
	}

	public function run(){
		// Cчитываем кеш если он есть

			$menu = Yii::$app->cache->get('header_menu');
			if ($menu) return $menu;
			$this->data = Categories::find()->where(['public_in_menu'=>1])->andWhere(['public'=>1])->andWhere(['parent_id'=>[NULL,0]])->indexBy('id')->asArray()->all(); 
			$this->menuHtml = $this->getMenuHtml($this->data);
			Yii::$app->cache->set('header_menu', $this->menuHtml, 60); //change
			return $this->menuHtml;
	}

	/* Функция передает каждую категорию построенного дерева через цикл функции catToTemplate
	   Параметр $tree необходим для построения первого уровня категорий.
	*/
	protected function getMenuHtml($tree){
		$str='';
		foreach ($tree as $category){
			$str .= $this->catToTemplate($category);
		}
		return $str;
	}

	/*Функция в качестве параметра принимает отдельные категории и передает данные шаблону tpl*/
	protected function catToTemplate($category){
		ob_start();
		include __DIR__ . '/views/header_menu.php';
		return ob_get_clean();
	}


}