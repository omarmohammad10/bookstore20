<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class AuthorModel extends Model
{
  public static function addAuthor(){
    $DB = Database::getConnection();

    $stmt = $DB->prepare("INSERT INTO authors (name , bio)
    VALUES (:name , :bio)");

    $stmt->execute([
      'name' => Request::input('authorName'),
      'bio' => Request::input('authorBio')
    ]);
    $authorId = $DB->lastInsertId();
    $stmt = $DB->query("SELECT * FROM authors WHERE id = '{$authorId}';");
    return $stmt->fetch();
  }
}
