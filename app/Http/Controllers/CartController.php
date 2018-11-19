<?php

namespace App\Http\Controllers;
use App\Cart;
use App\Product;
use App\ProductType;
use Session;
use Hash;

use Illuminate\Http\Request;

class CartController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | creat new cart and call function to add product in cart
    |-------------------------------------------------------------------------- 
    | input: $req is request from user
    |        $id is indentify of product
    | creat new cart when user buy a product
    | new cart is old cart with new product
    | 
    */
    public function getAddToCart(Request $req, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | creat new cart and call function to remove a product in cart
    |-------------------------------------------------------------------------- 
    | input: $id is indentify of product
    | creat new cart when user remove a product
    | new cart is old cart without that product
    | 
    */
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) >= 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('get');
        }
        return redirect()->back();
    }
   
}
