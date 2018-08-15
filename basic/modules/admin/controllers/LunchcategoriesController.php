<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\LunchCategories;
use app\modules\admin\models\LunchCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * LunchcategoriesController implements the CRUD actions for LunchCategories model.
 */
class LunchcategoriesController extends Controller
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
     * Lists all LunchCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LunchCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $lunchcategoryId = Yii::$app->request->post('editableKey');
            $lunchcategories = lunchCategories::findOne($lunchcategoryId);
            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post=[];
            $posted = current($_POST['LunchCategories']);
            $post = ['LunchCategories' => $posted];

            // load model like any single model validation
            if ($lunchcategories->load($post)) {

                // can save model or do something before saving model
                $lunchcategories->save();
                $lunchcategories->getErrors();
                // debug($lunchcategories);
                // debug($categories);
                if (isset($posted['public'])) 
                {
                  if ($lunchcategories->public==1) {
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
     * Displays a single LunchCategories model.
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
     * Creates a new LunchCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LunchCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Категория {$model->name} сохранена");            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LunchCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', "Категория {$model->name} сохранена");            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LunchCategories model.
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
     * Finds the LunchCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LunchCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LunchCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
