<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Categories;
use app\modules\admin\models\CategoriesSearch;
// use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


/**
 * CategoryController implements the CRUD actions for Categories model.
 */
class CategoryController extends AppAdminController
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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // $searchModel = new CategoriesSearch();
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Categories::find()->with('category')
        // ]);        
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $categoryId = Yii::$app->request->post('editableKey');
            $categories = Categories::findOne($categoryId);
            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post=[];
            $posted = current($_POST['Categories']);
            $post = ['Categories' => $posted];

            // load model like any single model validation
            if ($categories->load($post)) {

                // can save model or do something before saving model
                $categories->save();
                $categories->getErrors();
                // debug($categories);
                // debug($categories);
                if (isset($posted['public'])) 
                {
                  if ($categories->public==1) {
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
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              $model->img = UploadedFile::getInstance($model, 'img');
              $model->back_img = UploadedFile::getInstance($model, 'back_img');
            if ($model->img) {
                $model->deleteImages('image');
                $model->uploadImage();
            }   
            if ($model->back_img) {
                $model->deleteImages('back_image');
                $model->uploadBackimage();
            }            
            Yii::$app->session->setFlash('success', "Категория {$model->name} сохранена.");  
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionDelimage($id, $image) 
    {
        $model = $this->findModel($id);
        $model->deleteImages($image);

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
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              $model->img = UploadedFile::getInstance($model, 'img');
              $model->back_img = UploadedFile::getInstance($model, 'back_img');
            if ($model->img) {
                $model->deleteImages('image');
                $model->uploadImage();
            }   
            if ($model->back_img) {
                $model->deleteImages('back_image');
                $model->uploadBackimage();
            } 
            Yii::$app->session->setFlash('success', "Категория {$model->name} сохранена.");  
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $id = Yii::$app->request->get('id'); 

        $model = $this->findModel($id);
        $model->deleteImages('image');
        $model->deleteImages('back_image');
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
