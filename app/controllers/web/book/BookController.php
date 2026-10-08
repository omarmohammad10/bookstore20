<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../../core/Request.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";
require_once __DIR__ . "/../../../models/book/BookModel.php";

class BookController extends Controller
{
  public function filterBooks()
  {
    $minPrice = Request::input('minPrice', '') == '' ? 0 : Request::input('minPrice');
    $maxPrice = Request::input('maxPrice', '') == '' ? null : Request::input('maxPrice');
    $stock = Request::input('stock', '') == '' ? null : Request::input('stock');

    $wheres = [
      ['authors.name', 'LIKE', '%' . Request::input('author', '') . '%'],
      ['books.title', 'LIKE', '%' . Request::input('title', '') . '%'],
      ['books.price', '>', "{$minPrice}"]
    ];

    if ($maxPrice != null) {
      array_push($wheres, ['books.price', '<', $maxPrice]);
    }

    if ($stock != null) {
      array_push($wheres, ['books.stock', '=', $stock]);
    }

    $sortBooks = BookModel::getDataOfBooks($wheres , Request::input('sort','DESC') , Request::input('page',1));

    Response::json($sortBooks);
  }
}
