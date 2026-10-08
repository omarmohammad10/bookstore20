<?php
require_once __DIR__ . "/Middleware.php";

class GuestMiddleware implements Middleware{
  public function handle(string ...$roles):void{
    if(isset($_SESSION['user'])){
      // http_response_code(403);
      // exit("You have already logged in");
      // Response::error("You have already logged in",403);
      redirect('/profile');
    }
  }
}