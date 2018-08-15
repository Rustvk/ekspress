<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Categories;
use app\models\Newsletters;
use app\models\SimplePages;
use app\models\Advert;
use app\models\Events;
use yii\caching\DbDependency;


class SiteController extends AppController
{
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
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='index';
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(mx) FROM (SELECT MAX(updated_at) as mx FROM categories UNION SELECT MAX(updated_at) as mx FROM product) s',
        ]);
        $cats = Yii::$app->db->cache(function ($db) {
            return Categories::find()
            ->joinWith([
                'product' => function ($query) {
                    $query->onCondition(['product.public' => 1])->orderBy(['product.order'=>SORT_ASC]);
                },
            ])
            ->where(['categories.public_in_menu'=>1])
            ->andWhere(['categories.public'=>1])
            ->orderBy('categories.order_num')
            ->all();
        }, 0, $dependency);

        $dependency_adv = new DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM advert',
        ]);
        $advert = Yii::$app->db->cache(function ($db) {
            return Advert::find()->where(['public'=>1])->one();
        }, 0, $dependency_adv);

        $company = $this->getCompany();
        $this->setMeta($company->name.', '.$company->description,'', $company->name.', '.$company->description);   
        return $this->render('index', compact('cats', 'advert'));

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // $this->layout = false;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionNewsletter($mail)
    {
        $model = new Newsletters();
        $emails = Newsletters::find()->all();
        foreach ($emails as $post) {
            if ($post->email == $mail) {
                return 'again';
            }
        }
        
        $model->email = $mail;
        if ($model->save()) {
                return 'success';
        }
    }
    /**
     * Displays contact page.
     *
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $company = $this->getCompany();
        $this->setMeta('Контакты '.$company->name, '', 'Контактные данные, адрес и телефон '.$company->name);  

        if ($model->load(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('success', 'Ваше письмо отправлено.');  
                Yii::$app->mailer->compose('contact_view', ['model'=>$model])
                ->setFrom(['mr-15@mail.ru' => 'Сайт "Кафе Экспресс"'])
                ->setTo($company->mail)
                ->setSubject('Обратная связь с сайта')
                ->send();
                return $this->refresh();
        }
        // debug($company);
        return $this->render('contact', compact('model', 'company'));
    }

    /**
     * Displays about page.
     *
     */
    public function actionAbout()
    {   
        $company = $this->getCompany();
        $about = SimplePages::findOne(1);
        $this->setMeta('О '.$company->name, '', 'О '.$company->name.', о самом заведении, его работе и его сотрудниках');   
        return $this->render('about', compact('about'));
    }


    public function actionEvents()
    {   
        $company = $this->getCompany();

        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM events',
        ]);
        $events = Yii::$app->db->cache(function ($db) {
            return Events::find()->where(['public'=>1])->all();
        }, 0, $dependency);  

        $this->setMeta('Организация мерроприятий в '.$company->name, '', 'Свадьбы, банкеты, юбилеи, праздники в  '.$company->name.', заказы на вынос');   
        return $this->render('events', compact('events'));
    }   
}
