<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class DBModel extends Model
{
  public static function getTotalOfTable(string $tableName, array $wheres = [])
  {
    $DB = Database::getConnection();
    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT COUNT(*) AS total FROM {$tableName} $whereQuery");
    $result = $stmt->fetch();
    return $result['total'];
  }

   public static function getTotalBoughtBooksOfCustomer()
  {
    $DB = Database::getConnection();
    $customerId = auth('id');
    $stmt = $DB->query("SELECT SUM(orders_items.quantity) AS total
    FROM orders_items LEFT JOIN orders ON orders.id = orders_items.order_id
    WHERE orders.customer_id = {$customerId} AND orders.status = 'done'");
    return $stmt->fetchColumn() ?? 0;
  }

  public static function getDataOfTable(string $tableName, array $wheres = [], int $page = 1): array
  {
    $DB = Database::getConnection();

    $offset = ($page * 10) - 10;

    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT * FROM {$tableName} {$whereQuery} ORDER BY id DESC LIMIT 10 OFFSET {$offset}");
    $data = $stmt->fetchAll();

    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT COUNT(*) AS total FROM {$tableName} {$whereQuery}");
    $total = $stmt->fetch()['total'];

    return [
      'data' => $data,
      'total' => $total,
      'currentPage' => $page
    ];
  }
  
  public static function getRoleofUser(string $userId): string
  {
    $DB = Database::getConnection();
    $stmt = $DB->query("SELECT role FROM users WHERE id = {$userId}");  
    return $stmt->fetchColumn();
  }
}
