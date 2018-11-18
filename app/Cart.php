<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	/*
	|--------------------------------------------------------------------------
	| construct function of Cart class 
	|--------------------------------------------------------------------------
	| creat new a cart to add product 
	| 
	*/
	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Add product to a cart 
	|--------------------------------------------------------------------------
	| input: $item is object of product class
	|		 $id is indentify of product 
	| output: a cart with added product
	| if product in cart, quantity of product add 1
	| else, add product in cart as new prduct 
	|
	*/
	public function add($item, $id){
		$price_unit_or_promo = $item->unit_price;
  		if($item->promotion_price != 0){
  			$price_unit_or_promo = $item->promotion_price;
  		}

  		$giohang = ['qty'=>0, 'price' => $price_unit_or_promo, 'item' => $item];
  		if($this->items){
  			if(array_key_exists($id, $this->items)){
  				$giohang = $this->items[$id];
  			}
  		}

  		$giohang['qty']++;
  		$giohang['price'] = $price_unit_or_promo * $giohang['qty'];

  		$this->items[$id] = $giohang; 
  		$this->totalQty++; 
  		$this->totalPrice += $price_unit_or_promo; 
	}
	/*
	|--------------------------------------------------------------------------
	| remove a product from cart 
	|--------------------------------------------------------------------------
	| input:  $id is indentify of product
	| output: reduce quantity of product by 1
	| and caculate total price
	| 
	*/
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	/*
	|--------------------------------------------------------------------------
	| remove product from cart
	|--------------------------------------------------------------------------
	| input: $id is indentify of product
	| output: cart has not product $id
	| 
	*/
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
