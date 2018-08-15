<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\LunchProducts;
use app\modules\admin\models\LunchCategories;
use app\modules\admin\models\LunchProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;


/**
 * LunchproductsController implements the CRUD actions for lunchProducts model.
 */
class LunchproductsController extends Controller
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
     * Lists all lunchProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new lunchProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $lunchproductId = Yii::$app->request->post('editableKey');
            $lunchproduct = lunchProducts::findOne($lunchproductId);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post=[];
            $posted = current($_POST['LunchProducts']);
            $post = ['LunchProducts' => $posted];

            // load model like any single model validation
            if ($lunchproduct->load($post)) {
            // can save model or do something before saving model
                $lunchproduct->save();
                if (isset($posted['public'])) 
                {
                  if ($lunchproduct->public==1) {
                    $output = '<span style="color:green">Опубликовано</span>';
                  } else {
                    $output = '<span class="text-danger">Не опубликовано</span>';
                  };
                }                
                $out = Json::encode(['output'=>$output,'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single lunchProducts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new lunchProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new lunchProducts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img) { 
                $model->deleteImages();
                $model->upload(); 
            }    
            Yii::$app->session->setFlash('success', "Блюдо {$model->name} сохранено."); 
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing lunchProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $old_image = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img) { 
                $model->deleteImages();
                $model->upload(); 
            }    
            Yii::$app->session->setFlash('success', "Блюдо {$model->name} сохранено."); 
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelimage($id) 
    {
        $model = $this->findModel($id);
        $model->deleteImages();

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            // Yii::$app->session->setFlash('success', "");
            // return 'Success';
            $content = 'Изображение успешно удалено';
            return $this->render('alert', compact('content'));
        } else {
            Yii::$app->session->setFlash('success', "Изображение успешно удалено."); 
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    public function actionMenu()
    {
        $lunchs = LunchCategories::find()
        ->joinWith([
            'lunchProducts' => function ($query) {
                $query->onCondition(['lunch_products.public' => 1])->orderBy(['lunch_products.order'=>SORT_ASC]);
            },
        ])
        ->where(['lunch_categories.public' => 1])
        ->andWhere(['lunch_categories.id' => ['1', '2', '3']])
        ->orderBy(['lunch_categories.order' => SORT_ASC])
        ->all();
        // debug($cat);

        // Формируем массив продуктов, ограниченный
        // $lunchs = $query->offset($pages->offset)->limit($pages->limit)->all();
        // debug($cat_products);

        // // Инициируем пагинацию
        // $pages = new Pagination([
        //     'totalCount'=>$query->count(), 
        //     'pageSize'=>$size,
        //     'forcePageParam' => false,
        //     'pageSizeParam' => false
        //     ]);
        // // Формируем массив продуктов, ограниченный
        // $products = $query->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('menu', compact('lunchs'));
    }
    /**
     * Deletes an existing lunchProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $id = Yii::$app->request->get('id'); 
        $model = $this->findModel($id);
        $model->deleteImages();
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the lunchProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return lunchProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = lunchProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
