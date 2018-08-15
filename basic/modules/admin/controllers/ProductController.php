<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductWithIngredients;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\ProductSearch;
// use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Json;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AppAdminController
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
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $productId = Yii::$app->request->post('editableKey');
            $product = Product::findOne($productId);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post=[];
            $posted = current($_POST['Product']);
            $post = ['Product' => $posted];

            // load model like any single model validation
            if ($product->load($post)) {
            // can save model or do something before saving model
            $product->save();
                if (isset($posted['public'])) 
                {
                  if ($product->public==1) {
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

    public function actionView($id)
    {
        $model = $this->findModel($id); 
        return $this->render('view', [
            'model' => $model,
        ]);
   
    }
   
    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductWithIngredients;
        $model->loadIngredients();
        $parent = Yii::$app->request->get('parent'); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->img = UploadedFile::getInstance($model, 'img');
            
            if ($model->img) { $model->upload(); }
            $model->saveIngredients();
            if ($model->parent_id>0) {
                Yii::$app->session->setFlash('success', "Вид блюда {$model->name} сохранен.");  
                return $this->redirect(['view', 
                    'id' => $model->parent_id,
                ]);
            } else {
                Yii::$app->session->setFlash('success', "Блюдо {$model->name} сохранено.");  
                return $this->redirect(['view', 
                    'id' => $model->id,
                ]);
            }
        } else {
            if ($parent) {
                $parent_product = Product::find()->where(['id'=>$parent])->one();
                return $this->render('create', [
                  'model' => $model,
                  'ingredients' => Ingredients::getAvailableIngredients(),
                  'parent' => $parent,
                  'parent_product' => $parent_product,
                  'categories' => $categories,
                ]);          
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'ingredients' => Ingredients::getAvailableIngredients(),
                ]);
            }
        }
    }
    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->loadIngredients();
        $old_image = $model->image;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // debug($model->ingredients_ids);

            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img) { 
                $model->deleteImages();
                $model->upload(); 
            }
            $model->saveIngredients();
            if ($model->parent_id>0) {
                Yii::$app->session->setFlash('success', "Вид блюда {$model->name} сохранен.");  
                return $this->redirect(['view', 
                    'id' => $model->parent_id,
                ]);
            } else {
                Yii::$app->session->setFlash('success', "Блюдо {$model->name} сохранено.");  
                return $this->redirect(['view', 
                    'id' => $model->id,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'ingredients' => Ingredients::getAvailableIngredients(),
            ]);
        }
    }
    // public function actionChangedaughter($id) {
    //     $model = new DaughterProducts;
    //     $model->loadIngredients();
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {

    //         $model->saveIngredients();
    //         Yii::$app->session->setFlash('success', "Вид блюда: {$model->name} сохранен.");  
    //         return $this->redirect(['view', 
    //             'id' => $model->parent_id,
    //         ]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //             'ingredients' => Ingredients::getAvailableIngredients(),
    //         ]);
    //     }        

    // }
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
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id'); 

        $model = $this->findModel($id);
        $model->deleteIngredients();
        $model->deleteImages();
        $model->delete();
        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            // Yii::$app->session->setFlash('success', "");
            // return 'Success';
            $content = 'Вид успешно удален';
            return $this->render('alert', compact('content'));
        } else {  
        return $this->redirect(['index']);
        }
    }
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductWithIngredients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
