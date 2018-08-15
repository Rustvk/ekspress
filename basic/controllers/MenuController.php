<?php
// Для каждого создаваемого класса мы должны прописывать пространство имен (namespace), чтобы его нашли другие классы.
namespace app\controllers;

// Таким образом мы ищем другие классы и подключаем их чтобы использовать объявленные в них функции.
use app\models\Categories;	// Модель Categories отвечает за подключение к таблице категорий в бд
use app\models\Product;		// Модель Product отвечает за подключение к таблице продуктов в бд
use app\models\Ingredients;	// Модель Ingredients отвечает за подключение к таблице с ингредиентами в бд
use Yii;					// С помощью Yii мы получаем доступ к экземпляру приложения, в котором хранятся сессии, параметры из конфигурации и т.д.
use yii\data\Pagination;	// Класс отвечающий за инициализацию пагинации.
use yii\helpers\ArrayHelper;	// Класс отвечающий за инициализацию пагинации.
use yii\caching\DbDependency; // Класс для определения зависимостей кеширования БД


// Объявили класс MenuController, отвечающий за страницы меню. Site.ru/menu
class MenuController extends AppController {
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
	// Объявили функцию actionIndex, отвечающий за главную страницу меню. Site.ru/menu/index
	public function actionIndex() {
		// Получаем доступ к сессиям
		$session =Yii::$app->session;

		// Получаем параметр переданный по ссылке методом GET// Этот параметр отвечает за количество продуктов на странице. Три кнопки.
		$size = Yii::$app->request->get('pageSize');
		//Если параметр отсутствует то по умолчанию он равен девяти
		if (!$size){$size=9;}

        
			// если данных в нем нет, то из таблицы категорий возвращаем опубликованную категорию у которой class = index,
			// ограничиваем до 1 записи для получения единственной категории, также выводим в одномерный массив.        	
        $category = Categories::find()->where(['public' => 1])->andWhere(['class'=>'index'])->limit(1)->one();

		// Обращаемся к функции определенной в appController
		$company = $this->getCompany();

        $dependency_pr = new DbDependency([
            'sql' => 'SELECT MAX(mx) FROM (SELECT MAX(updated_at) as mx FROM categories UNION SELECT MAX(updated_at) as mx FROM product) s',
        ]);

		$query = Product::find()
		->joinWith('category')
		->orderBy('order')
		->where(['categories.public'=>1])
		->andWhere(['product.public'=>1])
		->andWhere(['product.parent_id'=>['NULL', NULL, 0]])
		->andWhere(['product.popular'=>1]);

		// Инициируем пагинацию
		$pages = new Pagination([
			'totalCount'=>$query->count(), 
			'pageSize'=>$size,
			'forcePageParam' => false,
			'pageSizeParam' => false
		]);

        $products = Yii::$app->db->cache(function ($db) use ($pages, $query) {
			return $query->offset($pages->offset)->limit($pages->limit)->with('subProducts')->all();
        }, 0, $dependency_pr);	

		$this->setMeta('Банкетное меню '.$company->name);

		// Возвращаем виду view сформированные данные. По умолчанию в конфигурации выставлен шаблон (общие части страниц) - view/layout/main.php 
		return $this->render('view', compact('products', 'pages', 'category', 'session'));
	}
// Объявили функцию actionIndex, отвечающий за главную страницу меню. Site.ru/menu/index
	public function actionChild() {
		$session =Yii::$app->session;
		$size = Yii::$app->request->get('pageSize');
		if (!$size){$size=9;}
        $category =  Categories::find()->where(['public' => 1])->andWhere(['class'=>'child'])->limit(1)->one();

		$company = $this->getCompany();

        $dependency_pr = new DbDependency([
            'sql' => 'SELECT MAX(mx) FROM (SELECT MAX(updated_at) as mx FROM categories UNION SELECT MAX(updated_at) as mx FROM product) s',
        ]);

		$query = Product::find()->joinWith('category')->where(['categories.public'=>1])->andWhere(['product.public'=>1])->andWhere(['product.parent_id'=>['NULL', NULL, 0, '0', '(NULL)', '']])->andWhere(['product.child'=>1]);

		// Инициируем пагинацию
		$pages = new Pagination([
			'totalCount'=>$query->count(), 
			'pageSize'=>$size,
			'forcePageParam' => false,
			'pageSizeParam' => false
			]);

        $products = Yii::$app->db->cache(function ($db) use ($pages, $query) {
			return $query->offset($pages->offset)->limit($pages->limit)->with('subProducts')->all();
        }, 0, $dependency_pr);	

		$this->setMeta('Меню '.$company->name.', '.$category->name, $category->meta_key, $category->description);	
		return $this->render('view', compact('products', 'pages', 'category', 'session'));
	}
	public function actionView($id) {

		$session =Yii::$app->session;
        $category = Categories::find($id)->where(['public'=>1])->andWhere(['id'=>$id])->one();

		// Если категории не найдено то отдаем ошибку 404. Это нужно в случае если пользователь вручную подставит параметры
		if (empty($category)) throw new \yii\web\HttpException(404, 'К сожалению такой категории не найдено.');

		$size = Yii::$app->request->get('pageSize');
		if (!$size){$size=9;}

        $dependency_pr = new DbDependency([
            'sql' => 'SELECT MAX(mx) FROM (SELECT MAX(updated_at) as mx FROM categories UNION SELECT MAX(updated_at) as mx FROM product) s',
        ]);

		$query = Product::find()->where(['public'=>1])->andWhere(['category_id'=>$id])->andWhere(['product.parent_id'=>['NULL', NULL, 0]]);
		$pages = new Pagination([
			'totalCount'=>$query->count(), 
			'pageSize'=>$size,
			'forcePageParam' => false,
			'pageSizeParam' => false
			]);

        $products = Yii::$app->db->cache(function ($db) use ($pages, $query) {
			return $query->offset($pages->offset)->limit($pages->limit)->with('subProducts')->all();
        }, 0, $dependency_pr);			
		$company = $this->getCompany();

		$this->setMeta('Меню '.$company->name.', '.$category->name, $category->meta_key, $category->description);	
		return $this->render('view', compact('products', 'pages', 'category', 'session'));
	}

	public function actionSearch() {
		// Выше
		$session =Yii::$app->session;

		// Получаем get запрос и обрезаем его от пробелов
		$q = mb_strtolower(trim(Yii::$app->request->get('q')));

		// Заранее проставляем заголовок страницы
		$this->setMeta('Поиск по запросу: ' .$q);

		// Если запрос пуст
		if (!$q) {

			// Если запрос ajax
			if (Yii::$app->request->isAjax) {

				// То отключаем вид шаблона (поскольку через ajax мы передаем в специальное окно, футер и хедер нам не нужны)
				$this->layout = false;
				return $this->render('search_ajax');
			}
			// Если не ajax
			else {
				// Возвращаем целый вид. Т.е. загрузится целая страница в шаблоне (layout/main)
				return $this->render('search');
			}
		}
		
		// Выше
		$query = Product::find()
		->joinWith('category')
		->where(['categories.public'=>1])
		->andWhere(['product.public'=>1])
		->andWhere(['like', 'product.name', $q])
		->andWhere(['product.parent_id'=>['NULL', NULL, 0]])
		->orderBy('product.category_id');

		// Получаем категории - для результатов поиска
		$cats = Categories::find()->where(['public'=>1])->andWhere(['like', 'name', $q])->all();
		$size=8;
		$pages = new Pagination([
			'totalCount'=>$query->count(), 
			'pageSize'=>$size,
			'forcePageParam' => false,
			'pageSizeParam' => false
		]);

		if (Yii::$app->request->isAjax) {
			$this->layout = false;
			// Не разбиваем результаты на страницы, а передаем целиком
			$products = $query->with('subProducts')->all();
			return $this->render('search_ajax', compact('products', 'q', 'cats', 'session'));
		} else {		
			$products = $query->offset($pages->offset)->limit($pages->limit)->with('subProducts')->all();
			if (count($products)==1) {
				return $this->redirect(['/product/view', 'id'=>$products[0]->id]);
			} else {
			return $this->render('search', compact('products', 'pages', 'q', 'cats', 'session'));
			}
		}
	}

}

?>