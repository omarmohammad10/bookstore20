<?php


class Request{
  public static function all(): array{
    $json = json_decode(file_get_contents('php://input'),true); 
    // Get data from input php
    $allData = array_merge(
      $_GET,
      $_POST,
      is_array($json) ? $json : []
    );
    unset($allData['url']);
    return $allData;
  }
  
  public static function input(string $key, mixed $default = null):mixed{
    return self::all()[$key] ?? $default;
  } // Get data of specific input from url

  public static function validate(array $rules):array{
    $validator = new Validation(self::all(),$rules);
    $errors = $validator->validate();
    $_SESSION["_errors"] = $errors;
    $_SESSION["_old"] = self::all();
    return $errors;
  }
}