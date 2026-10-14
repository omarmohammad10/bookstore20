<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class AdminModel extends Model
{
  public static function banUser(){
    $DB = Database::getConnection();
    $userId = Request::input('userId');
    $stmt = $DB->query("SELECT * FROM users WHERE id = '{$userId}';");
    $user = $stmt->fetch(); // Copy of the database

    $stmt = $DB->prepare("UPDATE users SET is_banned = :newBan WHERE id = :userId");
    $user['is_banned'] = !$user['is_banned'];
    // Update is_banned after sending the old version of the database

    $stmt->execute([
      'newBan' => $user['is_banned'],
      'userId' => $userId
    ]);

    return $user;
  }
}