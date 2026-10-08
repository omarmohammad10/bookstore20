<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class BookModel extends Model{
  public static function getDataOfBooks(array $wheres = [], string $sort = "DESC",int $page = 1): array
  {
    $DB = Database::getConnection();
    
    $whereQuery = Model::prepareWhereQuery($wheres);
    $offset = ($page * 10) - 10;

    // Response::json(['SELECT books.*,authors.name AS author_name FROM books
    //  LEFT JOIN authors ON authors.id = books.author_id {$whereQuery} ORDER BY id {$sort} LIMIT 10 OFFSET {$offset}']);
     
    $stmt = $DB->query("SELECT books.*,authors.name AS author_name FROM books
     LEFT JOIN authors ON authors.id = books.author_id {$whereQuery} ORDER BY id {$sort} LIMIT 10 OFFSET {$offset}");
    $data = $stmt->fetchAll();

    $whereQuery = Model::prepareWhereQuery($wheres);
    $stmt = $DB->query("SELECT COUNT(*) AS total FROM books LEFT JOIN authors ON authors.id = books.author_id {$whereQuery}");
    $total = $stmt->fetch()['total'];

    return [
      'data' => $data,
      'total' => $total,
      'currentPage' => $page
    ];
  }

}

// SELECT books.*,authors.name AS author_name FROM books LEFT JOIN authors ON authors.id = books.author_id WHERE (authors.name LIKE '%%' OR books.title LIKE '%%' OR books.stock = '') AND (books.price > '0' AND books.price < '200') ORDER BY id DESC LIMIT 10 OFFSET 0;