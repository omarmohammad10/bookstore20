<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "/../../../models/book/BookModel.php";
require_once __DIR__ . "/../../../models/order/OrderModel.php";

class ProfileController extends Controller
{
  public function index()
  {
    $data = $this->getAdminData();
    // pr($data, true);
    $this->view("profile/Profile",$data);
  }

  private function getAdminData(): array
  {
    $total = [
      'books' => DBModel::getTotalOfTable('books'),
      'authors' => DBModel::getTotalOfTable('authors'),
      'customers' => DBModel::getTotalOfTable('users', [['role', '=', 'customer']]),
      'admins' => DBModel::getTotalOfTable('users', [['role', '=', 'admin']]),
      'orders' => [
        'ordered' => DBModel::getTotalOfTable('orders',[['status', '=', 'ordered']]),
        'cancelled' => DBModel::getTotalOfTable('orders',[['status', '=', 'cancelled']]),
        'done' => DBModel::getTotalOfTable('orders',     
        [['status', '=', 'done']])
      ]
    ];

    $admins = DBModel::getDataOfTable('users', [
      ['role', '=', 'admin'],
      ['id', '!=', auth('id')],
      ],Request::input('admins-page',1));
    $customers = DBModel::getDataOfTable('users', [['role', '=', 'customer']], Request::input('customers-page',1));
    $authors = DBModel::getDataOfTable('authors',page:Request::input('authors-page',1));
    $books = BookModel::getDataOfBooks(page:Request::input('books-page',1));
    $orders = [
      'ordered' => OrderModel::getDataOfOrders([['status', '=', 'ordered']] , Request::input('orders_ordered-page',1)),
      'cancelled' => OrderModel::getDataOfOrders([['status', '=', 'cancelled']],Request::input('orders_cancelled-page',1)),
      'done' => OrderModel::getDataOfOrders([['status', '=', 'done']],Request::input('orders_done-page',1))
    ];

    return [
      'total' => $total,
      'admins' => $admins,
      'customers' => $customers,
      'authors' => $authors,
      'books' => $books,
      'orders' => $orders
    ];
  }
}
