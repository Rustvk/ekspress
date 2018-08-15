<?php

namespace app\controllers;
use app\models\Categories;
use app\models\Product;
use app\models\Ingredients;
use Yii;

class ProductController extends AppController {
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
	public function actionView($id) {
		$session =Yii::$app->session;
		$product = Product::findOne($id);
		if (($product->parent_id)!=0) {
			throw new \yii\web\HttpException(404, 'К сожалению такого продукта не найдено.');
		}
		else {
			$sub_product = Product::find()->with('consist')->where(['parent_id'=>$product->id])->all();
			if (empty($sub_product)) {
				$product = Product::find()->with('consist')->joinWith('category')->where(['product.id'=>$id])->andWhere(['categories.public'=>1])->andWhere(['product.public'=>1])->one();
			}	
		}
		if (empty($product)) throw new \yii\web\HttpException(404, 'К сожалению такого продукта не найдено.');

		$company = $this->getCompany();
		$this->setMeta('Меню '.$company->name.', '.$product->name, $product->meta_key, $product->description);	
		return $this->render('view', compact('product', 'ingredients', 'session', 'sub_product'));
	}
}


?>