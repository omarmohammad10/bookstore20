<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/cart/CartModel.php";
class CartController extends Controller
{
  public function addToCart()
  {
    // Response::json(Request::all());
    $errors = Request::validate([
      'bookId' => ['required',['exists','books','id']],
      'quantity' => ['required']
    ]);
    if(!empty($errors)){
      Response::json($errors , status: 422);
    }
    CartModel::addToCart();
    $totalItems = CartModel::totalOrderItems();
    Response::json([
      'totalItems' => $totalItems
    ]);
  }

  public function getCartItems(){
    $data = CartModel::getCartItems();
    Response::json($data);
  }
}