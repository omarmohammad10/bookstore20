<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/admin/AdminModel.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";

class AdminController extends Controller
{
  public function banUser(){
    // Response::json(Request::all());
    $errors = Request::validate([
      'userId' => ['required',['exists','users','id']]
    ]);
    if(!empty($errors)){
      Response::json($errors,"Id does not exist",status: 422);
    }
    $idOfBanUser = Request::input('userId');
    $roleOfBanUser = DBModel::getRoleofUser($idOfBanUser);

    if($roleOfBanUser == 'admin' && auth('id') > $idOfBanUser){
      Response::json([] , "You are forbidden" , 403);
      
    }

    $user = AdminModel::banUser();

    Response::json($user);
  }
}