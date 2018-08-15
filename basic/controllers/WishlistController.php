<?php

namespace app\controllers;
use app\models\Categories;
use app\models\Product;
use app\models\OrderItems;
use app\models\Order;
use app\models\Wishlist;
use Yii;

class WishlistController extends AppController {

	public function actionAdd() {
		$id = Yii::$app->request->get('id');
		$session =Yii::$app->session;
		$session->open();
		if ($id=='load') {
			$this->layout = false;
			return $this->render('wishlist_modal', compact('session'));
		}
		else {

            $product = Product::find()
            ->with('parentProduct')
            ->joinWith('category')
            // Следует отлечать oncondition от andWhere - поскольку он кондишн добавить джоин в выборку по условию, но это не условие самой выборки. 
            ->where(['product.id'=>$id])
            ->andWhere(['product.public'=>1])
            ->andWhere(['categories.public'=>1])
            ->one();		
            // debug($product);
			// die;
			if (empty($product)) return false;
			$wishlist = new Wishlist();
			$wishlist->addToWishlist($product);

			// $session->destroy();
			if (Yii::$app->request->isAjax) {
				$this->layout = false;
				return $this->render('wishlist_modal', compact('session'));
			} else {		
				return $this->redirect(Yii::$app->request->referrer);
			}
		}
	}
	public function actionDelete() {
		$id = Yii::$app->request->get('id');
		$session =Yii::$app->session;
		$session->open();
		$wishlist = new Wishlist();
		$wishlist->recalc($id);
		if (Yii::$app->request->isAjax) {
			$this->layout = false;
			return $this->render('wishlist_modal', compact('session'));
		} else {		
			// return $this->render('wishlist_modal', compact('session'));
			return $this->redirect(Yii::$app->request->referrer);
		} 		
	}
	public function actionClear() {
		$id = Yii::$app->request->get('id');
		$session =Yii::$app->session;
		$session->open();
		$session->remove('wishlist');
		$session->remove('wishlist.qty');
		$session->remove('wishlist.summ');
		if (Yii::$app->request->isAjax) {
			$this->layout = false;
			return $this->render('wishlist_modal', compact('session'));
		} else {		
			return $this->redirect(Yii::$app->request->referrer);
		}		
	}
	public function actionView() {
		$session =Yii::$app->session;
		$session->open();
		$this->setMeta('Список пожеланий');
		$company =$this->getCompany();
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['wishlist.qty'];
            $order->summ = $session['wishlist.summ'];
            if ($order->save()) {                    
                $this->saveOrderItems($session['wishlist'], $order->id);                  
                Yii::$app->session->setFlash('success', 'Ваше письмо отправлено.');  
                Yii::$app->mailer->compose('order', ['session'=>$session, 'order'=>$order])
                ->setFrom(['mr-15@mail.ru' => 'Сайт "Кафе Экспресс"'])
                ->setTo($company->mail)
                ->setSubject('Заявка на меню с сайта')
                ->send();

                $session->remove('wishlist');
                $session->remove('wishlist.qty');
                $session->remove('wishlist.sum'); 
                return $this->refresh();
            }
            else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при отправке');
                return $this->refresh();
            }
        }
            // return $this->render('order_form', compact('order'));
		return $this->render('wishlist_page', compact('session', 'order'));   
	}

    protected function saveOrderItems($items, $order_id) {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->save();
        }
    }

	public function actionPrint() {
		$session =Yii::$app->session;
		$session->open();
		$this->layout = false;
		return $this->render('wishlist_print_page', compact('session'));   
	}    


}