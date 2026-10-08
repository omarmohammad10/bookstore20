<?php



require_once __DIR__ . "/Middleware.php";

class AuthMiddleware implements Middleware
{
  public function handle(string ...$roles): void
  {

    if (!isset($_SESSION['user'])) {
      // http_response_code(401);
      // exit("Unauthorized");
      // Response::error("Unauthorized",401);
      redirect('/auth/login');
    }

    if (empty($roles)) {
      return;
    } // User has logged in but no role is sent , so it will transfer to the controller

    $currentRoleAuth = $_SESSION['user']['role'];

    if (!in_array($currentRoleAuth, $roles)) {
      // http_response_code(403);
      // exit("Forbidden");
      Response::error("Forbidden",403);
    }
  }
}
