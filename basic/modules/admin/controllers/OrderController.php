<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Categories;
use app\modules\admin\models\Order;
use app\modules\admin\models\OrderItems;
use app\modules\admin\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;


/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


         if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $orderId = Yii::$app->request->post('editableKey');
            $order = Order::findOne($orderId);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post=[];
            $posted = current($_POST['Order']);
            $post = ['Order' => $posted];

            // load model like any single model validation
            if ($order->load($post)) {
            // can save model or do something before saving model
            $order->save();
                if (isset($posted['new'])) 
                {
                  if ($order->new==1) {
                    $output = 'Новый';
                  } else {
                    $output = '<span style="color:green">Просмотрен</span>';
                  };
                }
                if (isset($posted['status'])) 
                {
                  if ($order->status==0) {
                    $output = 'Активен';
                  } elseif ($order->status==1) {
                    $output = '<span style="color:green">Завершен</span>';
                  };
                }
                $out = Json::encode(['output'=>$output,'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }
        // $dataProvider = new ActiveDataProvider([
            // 'query' => $query,
            // 'query' => Order::find(),
            // 'pagination' => [
                // 'pageSize' => 10,
            // ],
            // 'sort' => [
                // 'defaultOrder' => [
                    // 'created_at' => SORT_DESC
                // ]
            // ]
        // ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model['new'] = 0;
        $model->save();
        // $model->getErrors();
        // debug($model);


        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Заказ от {$model->name} сохранен.");  
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Заказ от {$model->name} сохранен.");  
            return $this->redirect(['view', 'id' => $model->id]);
        } else {          
            return $this->render('update', [
                'model' => $model,
                // 'categories' => Categories::getAvailableItems(),
            ]);
        }
    }

    public function actionEditproducts($id)
    {
        $model = $this->findModel($id);
        $model->loadItems();
        $this->layout = false;
        return $this->render('orderitems', [
            'model' => $model,
            'categories' => Categories::getAvailableItems(),
        ]);
    }
    public function actionSaveproducts($id)
    {
        $model = $this->findModel($id);
        $products = Yii::$app->request->get('products');
        $this->layout = false;

        if ($model->saveItems($products)) {
          return 'success';
        } else {
          return 'fail';
        } 
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
