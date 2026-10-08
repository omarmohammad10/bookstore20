<?php
require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/auth/Auth.php";

class LoginController extends Controller
{
  public function index()
  {
    $this->view("auth/Login");
  }

  public function login(){
    $errors = Request::validate([
      'email' => ['required','email'],
      'password' => ['required']
    ]);
    if(!empty($errors)){
      back();
    }
    if(Auth::login()){
      $_SESSION['_old'] = [];
      session_regenerate_id(true);
      // Data remains in the session but session id changed
      redirect('/profile');
    }
    back('invalid','Invalid Account');
  }

  public function logout(){
    unset($_SESSION['user']);
    session_regenerate_id(true);
    redirect('/auth/login');
  }
}
