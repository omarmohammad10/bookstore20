<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";

class RegisterController extends Controller
{
  public function index()
  {
    $this->view("auth/Register");
  }

  public function register()
  {
    $errors = Request::validate([
      'role' => ['required'],
      'name' => ['required'],
      'email' => ['required', 'email', ['unique', 'users']],
      'password' => ['required', ['min', 8]],
      'phone' => ['required',['unique','users'],'egPhone'],
      'gender' => ['required'],
    ]);

    if (!empty($errors)) {
      back();
    }

    if (Request::input('role') === 'admin' && !isAuth('admin')) {
      back('invalid',"You must login as admin");
    }

    UserModel::createUser();
    $newRole = Request::input('role');
    back("correct", "A new {$newRole} created successfully");
  }
}
