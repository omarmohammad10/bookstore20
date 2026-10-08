<?php
require_once __DIR__ . "/../Controller.php";
require_once __DIR__ . "/../../models/user/UserModel.php";
// No inheritance from web controller
class UserController{
  public function getData(){
    // $users = [
    //   ["id" => "5" , "name" => "Omar Mohammad"],
    //   ["id" => "6" , "name" => "Mohammad Adel"]
    // ];

    $userModel = new UserModel();
    $users = $userModel->getUsers();

    echo json_encode([
      'message' => 'done',
      'data' => $users
    ]);
    Response::json(Request::all(), "Done");
  }
}