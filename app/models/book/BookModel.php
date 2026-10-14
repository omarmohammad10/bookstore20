<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class BookModel extends Model
{
  public static function getDataOfBooks(array $wheres = [], string $sort = "DESC", int $page = 1): array
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

  // public static function filterBooks()
  // {
  //   $DB = Database::getConnection();
  // }

  public static function addBook()
  {
    $DB = Database::getConnection();
    $stmt = $DB->prepare("INSERT INTO books 
    (author_id,title,image,description,price,stock) 
    VALUES 
    (:author_id,:title,:image,:description,:price,:stock);");

    $stmt->execute([
      'author_id' => Request::input('bookAuthorId'),
      'title' => Request::input('bookTitle'),
      'image' => self::uploadImage('bookImage'),
      'description' => Request::input('bookDesc'),
      'price' => Request::input('bookPrice'),
      'stock' => Request::input('bookStock')
    ]);

    $newBookId = $DB->lastInsertId();
    $newBook = self::getDataOfBooks([
      ['books.id','=',$newBookId]
    ])['data'][0];
    return $newBook;
  }

  private static function uploadImage(string $fileName): ?string
  {
    if (Request::hasFile($fileName)) {
      $file = Request::file($fileName);
      $fileName = $file['name'];
      $fileOriginalName = pathinfo($fileName,PATHINFO_FILENAME);
      $fileOriginalExtension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
      $fileTmp = $file['tmp_name'];
      $allowedExtensions = ['png','jpg','jpeg'];
      if(!in_array($fileOriginalExtension,$allowedExtensions)){
        Response::error("Extension is not allowed" , 403);
      }

      $fileNewName = $fileName . "_" . time() . "." . $fileOriginalExtension;
      // Create New File Name
      $uploadDir = __DIR__ . "/../../../public/assets/images/uploads";
      // Create New Directory for image
      if(!is_dir($uploadDir)){
        mkdir($uploadDir);
      }

      $uploadPath = $uploadDir . "/" . $fileNewName;
      // From temp path to the new path
      if(!move_uploaded_file($fileTmp,$uploadPath)){
        Response::error("Something went wrong",403);
      }
      return $fileNewName;
    } else {
      return null;
    }
  }
}

