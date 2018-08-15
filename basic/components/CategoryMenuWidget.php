<?php

namespace app\components;
use yii\base\Widget;
use app\models\Categories;
use Yii;
use yii\caching\DbDependency;

class CategoryMenuWidget extends Widget {

	public $tpl; /* Шаблон UL для клиента или select для админа */
	public $active; /* Id категории из параметра */
	public $data; /* Записи категорий из БД */
    public $model; /* Нужно для админки - передаем значение текущего экземпляра модели. проще говоря - запись категории на странице которой мы находимся */
	public $tree; /* Результат работы функции - из массива строится дерево со вложенностью */
	public $menuHtml; /* Готовый HTML код в зависимости от шаблона */
	public $xxx; /* Готовый HTML код в зависимости от шаблона */


	public function init() {
		parent::init();

		if( $this->tpl === null) {
			$this->tpl = 'cat_menu';
		}
		if ($this->tpl === 'select') {
			$this->tpl = 'cat_select';
		}

		$this->tpl .= '.php';
	}

	public function run(){
	        $dependency = new DbDependency([
	            'sql' => 'SELECT MAX(updated_at) FROM categories',
	        ]);        

        if ($this->tpl=='cat_select.php') {
	        $categories_adm = Yii::$app->db->cache(function ($db) {
	            return Categories::find()->indexBy('id')->asArray()->all();
	        }, 3600, $dependency); 
	        
   			$this->xxx = $categories_adm[$this->active]['parent_id'];
			$this->data = $categories_adm;

        } else {
	        $categories = Yii::$app->db->cache(function ($db) {
	            return Categories::find()->where(['public_in_cat'=>1])->andWhere(['public'=>1])->orderBy('order_num')->indexBy('id')->asArray()->all();
	        }, 3600, $dependency); 

   			$this->xxx = $categories[$this->active]['parent_id'];
			$this->data = $categories;
        }

		$this->tree = $this->getTree();
		$this->menuHtml = $this->getMenuHtml($this->tree);

		//Записываем меню в кеш, если меню в кеше отсутствует, запись на 15 секунд
        // Yii::$app->cache->set('menu', $this->menuHtml, 60);
		return $this->menuHtml;
	}

	/* Если в категориях существует вложенность - функция строит дерево каждая ветвь которой именуется полем child и её значением является вложенный массив дочерней категории или категорий. Связь создается по полю parent_id в таблице категорий */
	protected function getTree(){
		$tree=[];

		foreach ($this->data as $id=>&$node) {

			if (!$node['parent_id'])
				{
					$tree[$id] = &$node;
				}
			else {
				$this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
				}		
		}
		return $tree;
	}

	/* Функция передает каждую категорию построенного дерева через цикл функции catToTemplate
	   Параметр $tree необходим для построения первого уровня категорий. В шаблоне в условии проверки пуст ли child, в качестве параметра будет передаваться $categody['childs']
	*/
	protected function getMenuHtml($tree, $tab = ''){
		$str='';
		foreach ($tree as $category){
			$str .= $this->catToTemplate($category, $active, $xxx,  $tab);
		}
		return $str;
	}

	/*Функция в качестве параметра принимает отдельные категории и передает данные шаблону tpl*/
	protected function catToTemplate($category, $active, $xxx,  $tab){
		ob_start();
		include __DIR__ . '/views/' .$this->tpl;
		return ob_get_clean();
	}


}