<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class OrderModel extends Model{
  public static function getDataOfOrders(array $wheres = [], int $page = 1): array
  {
    $DB = Database::getConnection();

    $offset = ($page * 10) - 10;

    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT orders.*,users.name AS customer_name FROM orders
     LEFT JOIN users ON users.id = orders.customer_id {$whereQuery} ORDER BY id DESC LIMIT 10 OFFSET {$offset}");
    $data = $stmt->fetchAll();

    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT COUNT(*) AS total FROM orders LEFT JOIN users ON users.id = orders.customer_id {$whereQuery}");
    $total = $stmt->fetch()['total'];

    return [
      'data' => $data,
      'total' => $total,
      'currentPage' => $page
    ];
  }
}