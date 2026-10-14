<?php
require_once __DIR__ . "/../core/Route.php";
require_once __DIR__ . "/../app/controllers/web/HomeController.php";
require_once __DIR__ . "/../app/controllers/web/auth/LoginController.php";
require_once __DIR__ . "/../app/controllers/web/auth/RegisterController.php";
require_once __DIR__ . "/../app/controllers/web/profile/ProfileController.php";
require_once __DIR__ . "/../app/controllers/web/user/UserController.php";
require_once __DIR__ . "/../app/controllers/web/author/AuthorController.php";
require_once __DIR__ . "/../app/controllers/web/admin/AdminController.php";
require_once __DIR__ . "/../app/controllers/web/book/BookController.php";
require_once __DIR__ . "/../app/controllers/web/cart/CartController.php";
require_once __DIR__ . "/../app/middleware/AuthMiddleware.php";
require_once __DIR__ . "/../app/middleware/GuestMiddleware.php";
require_once __DIR__ . "/../app/middleware/RegisterMiddleware.php";


Route::get("" , HomeController::class , "index");

Route::get("/auth/login" , LoginController::class , "index" ,[GuestMiddleware::class]);
Route::post("/auth/login" , LoginController::class , "login");
Route::get("/auth/logout" , LoginController::class , "logout" , [AuthMiddleware::class]);

Route::get("/auth/register" , RegisterController::class , "index",[RegisterMiddleware::class]);
Route::post("/auth/register" , RegisterController::class , "register" ,[RegisterMiddleware::class]);

Route::get("/profile" , ProfileController::class , "index" , [AuthMiddleware::class]);

Route::post("/profile/editName" , UserController::class , "editName" , [AuthMiddleware::class]);
Route::post("/profile/editEmail" , UserController::class , "editEmail" , [AuthMiddleware::class]);
Route::post("/profile/editGender" , UserController::class , "editGender" , [AuthMiddleware::class]);
Route::post("/profile/editPhone" , UserController::class , "editPhone" , [AuthMiddleware::class]);
Route::post("/profile/editPassword" , UserController::class , "editPassword" , [AuthMiddleware::class]);

Route::post("/profile/filterBooks" , BookController::class , "filterBooks" , [AuthMiddleware::class]);

/* Admin */

Route::post("/profile/addAuthor" , AuthorController::class , "addAuthor" , ["AuthMiddleware:admin"]);
Route::post("/profile/addBook" , BookController::class , "addBook" , ["AuthMiddleware:admin"]);
Route::post("/profile/banUser" , AdminController::class , "banUser" , ["AuthMiddleware:admin"]);


/* Customer */
Route::post("/profile/addToCart" , CartController::class , "addToCart" , ["AuthMiddleware:customer"]);
Route::post("/profile/getCartItems" , CartController::class , "getCartItems" , ["AuthMiddleware:customer"]);