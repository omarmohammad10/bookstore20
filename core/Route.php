<?php

class Route
{
  private static array $routes = [];

  public static function get(string $url, string $controller, string $action, array $middlewares = []): void
  {
    self::$routes[] = [
      "url" => $url,
      "method" => "GET",
      "controller" => $controller,
      "action" => $action,
      "middlewares" => $middlewares
    ];
  }

  public static function post(string $url, string $controller, string $action, array $middlewares = []): void
  {
    self::$routes[] = [
      "url" => $url,
      "method" => "POST",
      "controller" => $controller,
      "action" => $action,
      "middlewares" => $middlewares
    ];
  }

  public static function routes(): array
  {
    return self::$routes;
  }

  public static function dispatch()
  {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // From Request uri (Php) or redirect url (Apache)
    $url = rtrim($url, '/');
    $method = $_SERVER['REQUEST_METHOD'];

    $flag = false;
    
    foreach (self::$routes as $route) {
      $args = self::matchRoute(BASE_URL . $route['url'], $url);
      if ($args !== false) {
        if ($method !== $route['method']) {
          $flag = true;
          continue;
        }
        // Route true but method is false
        $flag = false;
        self::handleMiddleware($route['middlewares']);
        $obj = new $route['controller']();
        $obj->{$route['action']}(...$args);
        return;
      }
      // Check the route and its method
    }
    if($flag){
      Response::error("405 {$route['method']} is not allowed",405);
    }
    Response::error("404 Not found",404);
  }
  // Get the routes

  private static function editUrl(string &$url)
  {
    if (str_ends_with($url, '/')) {
      echo "ok";
      echo "<br>";
      $arr = explode("/", $url);
      unset($arr[count($arr) - 1]);
      $url = implode("/", $arr);
    }
  }

  private static function matchRoute(string $route, string $url): false|array
  {
    $regex = "/\{[A-Za-z_][A-Za-z_0-9]*\}/";
    $pattern = preg_replace($regex, "([^/]+)", $route);
    $pattern = "#^{$pattern}$#";

    if (!preg_match($pattern, $url, $matches)) {
      return false;
    }
    unset($matches[0]);
    return $matches;
  }
  private static function handleMiddleware(array $middlewares): void
  {
    foreach ($middlewares as $middleware) {
      $args = [];
      if (
        str_contains($middleware, ":")
      ) {
        $arr = explode(":", $middleware);

        // AuthMiddleware:admin,customer => ["AuthMiddleware" , "admin,customer"]
        $middleware = $arr[0];

        // "admin,customer" => ["admin" , "customer"]
        $args = explode(",", $arr[1]);
      }
      (new $middleware())->handle(...$args);
    }
  }
}
