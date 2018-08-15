<?php

namespace app\modules\admin\components;
use app\modules\admin\models\Order;
use yii\base\Widget;
// use app\modules\admin\models\CategoriesSearch;
use Yii;

class OrderCountWidget extends Widget{

	public function init() {
			parent::init();
	}

	public function run() {
		$orders = Order::find()->where(['new'=>1])->count();
		return $orders;
	}

}

