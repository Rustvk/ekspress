<?php
namespace app\models;
use yii\db\ActiveRecord;

class Wishlist extends ActiveRecord {
	public function addToWishlist($product, $qty = 1) {
		if(isset($_SESSION['wishlist'][$product->id])) {
		}
		else {
			if (($product->parentProduct->id==0)||($product->parentProduct->id==NULL)||($product->parentProduct->id=='NULL')) {
				$parent_id = $product->id;
				$img = $product->image;
				$name = $product->name;
			}
			else {
				$parent_id = $product->parentProduct->id;
				$img = $product->parentProduct->image;
				$name = $product->parentProduct->name . '<br>' . $product->name;
			}
			$_SESSION['wishlist'][$product->id] = [
				'qty'=> 1,
				'name' => $name,
				'price' => $product->price,
				'img' => $img,
				'category' => $product->category->name,
				'category_id' => $product->category->id,
				'parent_id' => $parent_id,
			];
			$_SESSION['wishlist.qty'] = isset($_SESSION['wishlist.qty']) ? $_SESSION['wishlist.qty'] + $qty : $qty;
			// $_SESSION['wishlist.summ'] = isset($_SESSION['wishlist.summ']) ? $_SESSION['wishlist.summ'] + $qty * $product->price : $qty * $product->price;
		}

	}
	public function recalc($id) {
		if(!isset($_SESSION['wishlist'][$id])) { return false;}
		$summMinus = $_SESSION['wishlist'][$id]['price']; 
		$_SESSION['wishlist.qty'] -= 1;
		// $_SESSION['wishlist.summ'] -= $summMinus;
		unset($_SESSION['wishlist'][$id]);
		
	}

}

?>