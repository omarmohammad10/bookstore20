<?php

require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/author/AuthorModel.php";

class AuthorController extends Controller
{
  public function addAuthor(){
    $errors = Request::validate([
      'authorName' => ['required'],
      'authorBio' => ['required']
    ]);

    if(!empty($errors)){
      Response::json($errors,"Unprocessable Entity",422);
    }
    
    $newAuthor = AuthorModel::addAuthor();

    Response::json($newAuthor , "New author has been added successfully");
  }
}