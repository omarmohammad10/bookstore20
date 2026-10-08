<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../../core/Request.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";

class UserController extends Controller{
  public function editName(){
    $errors = Request::validate([
      'name' => ['required']
    ]);
    if(!empty($errors)){
      $_SESSION['_errors'] = [];
      back('editAlert',['error', $errors['name'][0]]);
    }
    UserModel::editUser('name',Request::input('name'));
    $_SESSION['user']['name'] = Request::input('name');
    $_SESSION['_old'] = [];
    back('editAlert',['success',"Name has been updated successfully"]);
  }
  
  public function editEmail(){
    $errors = Request::validate([
      'email' => ['required','email',['unique','users',auth('id')]]
    ]);
    if(!empty($errors)){
      $_SESSION['_errors'] = [];
      back('editAlert',['error', $errors['email'][0]]);
    }
    UserModel::editUser('email',Request::input('email'));
    $_SESSION['user']['email'] = Request::input('email');
    $_SESSION['_old'] = [];
    back('editAlert',['success',"Email has been updated successfully"]);
  }

  public function editGender(){
    $errors = Request::validate([
      'gender' => ['required']
    ]);
    if(!empty($errors)){
      $_SESSION['_errors'] = [];
      back('editAlert',['error', $errors['gender'][0]]);
    }
    UserModel::editUser('gender',Request::input('gender'));
    $_SESSION['user']['gender'] = Request::input('gender');
    $_SESSION['_old'] = [];
    back('editAlert',['success',"Gender has been updated successfully"]);
  }

  public function editPhone(){
    $errors = Request::validate([
      'phone' => ['required','egPhone',['unique','users',auth('id')]]
    ]);
    if(!empty($errors)){
      $_SESSION['_errors'] = [];
      back('editAlert',['error', $errors['phone'][0]]);
    }
    UserModel::editUser('phone',Request::input('phone'));
    $_SESSION['user']['phone'] = Request::input('phone');
    $_SESSION['_old'] = [];
    back('editAlert',['success',"Phone has been updated successfully"]);
  }

  public function editPassword(){
    $errors = Request::validate([
      'password' => ['required']
    ]);
    if(!empty($errors)){
      $_SESSION['_errors'] = [];
      back('editAlert',['error', $errors['password'][0]]);
    }
    UserModel::editUser('password',Request::input('password'));
    $_SESSION['user']['password'] = Request::input('password');
    $_SESSION['_old'] = [];
    back('editAlert',['success',"Password has been updated successfully"]);
  }
}