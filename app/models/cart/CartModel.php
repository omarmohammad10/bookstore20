<?php
require_once __DIR__ . "/../Model.php";

class CartModel extends Model
{

  private static function getPendingOrderId(): false | int
  {
    $DB = Database::getConnection();
    $authId = auth('id');
    $stmt = $DB->query("SELECT id FROM orders WHERE customer_id = {$authId} AND status = 'pending'");
    return $stmt->fetchColumn();
  }

  private static function getOrderItemId(string $orderId, string $bookId): false | int
  {
    $DB = Database::getConnection();
    $stmt = $DB->query("SELECT id FROM orders_items WHERE order_id = {$orderId} AND book_id = {$bookId}");
    return $stmt->fetchColumn();
  }

  public static function totalOrderItems()
  {
    $DB = Database::getConnection();
    $orderId = self::getPendingOrderId();
    if ($orderId == false) {
      return 0;
    }
    $totalItems = $DB->query("SELECT COUNT(*) AS total FROM orders_items WHERE order_id = {$orderId}")->fetchColumn();
    return $totalItems;
  }

  private static function updateTotalPrice(string $orderId)
  {
    $DB = Database::getConnection();
    $totalPrice = $DB->query("SELECT SUM(subtotal) AS total FROM orders_items WHERE order_id = {$orderId}")->fetchColumn();

    $DB->exec("UPDATE orders SET total_price = {$totalPrice} WHERE id = {$orderId}");
  }

  public static function addToCart()
  {
    $DB = Database::getConnection();
    $authId = auth('id');
    $pendingOrderId = self::getPendingOrderId();

    if ($pendingOrderId == false) {
      $DB->exec("INSERT INTO orders (customer_id) VALUES ('{$authId}')");
      $pendingOrderId = $DB->lastInsertId(); // Get the latest created order id
    }
    // Create New Order if not exists

    $bookId = Request::input('bookId');
    $quantity = Request::input('quantity');
    $orderItemId = self::getOrderItemId($pendingOrderId, $bookId);
    $unitPrice = $DB->query("SELECT price FROM books WHERE id = '{$bookId}'")->fetchColumn();

    if ($orderItemId == false) {
      $stmt = $DB->prepare("INSERT INTO orders_items 
      (order_id, book_id, quantity, unit_price, subtotal)
      VALUES 
      (:order_id, :book_id, :quantity, :unit_price, :subtotal)");

      $stmt->execute([
        'order_id' => $pendingOrderId,
        'book_id' => $bookId,
        'quantity' => $quantity,
        'unit_price' => $unitPrice,
        'subtotal' => (float)$unitPrice * (int)$quantity
      ]);
    } else {
      $newSubtotal = $unitPrice * $quantity;
      $DB->exec("UPDATE orders_items SET 
      quantity = quantity + {$quantity}, 
      subtotal = subtotal + {$newSubtotal} 
      WHERE id = {$orderItemId}");
    }
    self::updateTotalPrice($pendingOrderId);
  }

  public static function getCartItems()
  {
    $DB = Database::getConnection();
    $stmt = $DB->prepare("SELECT 
    books.id AS book_id, 
    books.title,
    books.image,
    books.description, 
    books.price, 
    authors.id AS author_id,
    authors.name AS author_name,
    orders.id AS order_id,
    orders_items.id AS order_item_id, 
    orders_items.quantity, 
    orders_items.subtotal, 
    orders.total_price 
    FROM orders_items 
    LEFT JOIN orders ON orders.id = orders_items.order_id
    LEFT JOIN books ON books.id = orders_items.book_id
    LEFT JOIN authors ON authors.id = books.author_id
    WHERE orders.customer_id = :customer_id AND orders.status = 'pending'");
    
    $stmt->execute([
      'customer_id' => auth('id')
    ]);

    return $stmt->fetchAll();
  }
}

/* 
SELECT 
books.id AS book_id 
books.title,
books.image,
books.description, 
books.price, 
authors.id AS author_id
authors.name AS author_name,
orders.id AS order_id,
orders_items.id AS order_item_id, 
orders_items.quantity, 
orders_items.subtotal, 
orders.total_price 
FROM orders_items 
LEFT JOIN orders ON orders.id = orders_items.order_id
LEFT JOIN books ON books.id = orders_items.book_id
LEFT JOIN authors ON authors.id = books.author_id
WHERE orders.customer_id = 2 AND orders.status = 'pending'
*/
