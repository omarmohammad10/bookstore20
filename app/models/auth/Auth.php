<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class Auth extends Model
{
  public static function login(): bool
  {
    $DB = Database::getConnection();
    $email = Request::input('email');
    $password = Request::input('password');
    $stmt = $DB->query("SELECT * FROM users WHERE email = '{$email}';");
    $result = $stmt->fetch();
    if (!empty($result) && password_verify($password, $result['password'])) {
      $_SESSION['user'] = $result;
      return true;
    }
    return false;
  }
}
