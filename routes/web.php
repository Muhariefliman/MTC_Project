<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionheaderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('production')) {  
    URL::forceScheme('https');  
}

Route::get('/', [Controller::class, 'home']);
Route::get('/home', [Controller::class, 'home']);
Route::get('/home/search', [Controller::class, 'search'])->name('search');

Route::get('/register', [Controller::class, 'register']);
Route::post('/register', [UserController::class, 'registerUser'])->name('reg_user');
Route::get('/login', [Controller::class, 'login']);
Route::post('/login', [UserController::class, 'loginUser'])->name('login_user');
Route::get('/log_out', [UserController::class, 'logout'])->name('logout');

Route::get('/profile', [Controller::class, 'userProfilePage']);
Route::post('/profile', [UserController::class, 'updateProfile'])->name('update_user_name');

Route::get('/manageUser', [Controller::class, 'manageUser']);
Route::post('/manageUser', [UserController::class, 'deleteUser'])->name('delete_user');

Route::get('/userDetails/{id}', [UserController::class, 'userDetails']);
Route::post('/userDetails/{id}', [UserController::class, 'updateUserDetails'])->name('update_user_details');

Route::get('/changePassword', [Controller::class, 'changePassword']);
Route::post('/changePassword', [UserController::class, 'password'])->name('change_password');

Route::get('/genre', [Controller::class, 'genre']);
Route::post('/genre/insert', [GenreController::class, 'create'])->name('insert_genre');
Route::post('/genre/delete', [GenreController::class, 'destroy'])->name('delete_genre');
Route::get('/genre/{id}', [GenreController::class, 'genreDetails']);
Route::post('/genre/update', [GenreController::class, 'updateGenre'])->name('update_genre');

Route::get('/manageBook', [Controller::class, 'manageBook']);
Route::post('/manageBook/insert', [BookController::class, 'store'])->name('insert_book');
Route::post('/manageBook/delete', [BookController::class, 'deleteBook'])->name('delete_book');
Route::get('/details/{id}', [BookController::class, 'show']);
Route::post('/details/update', [BookController::class, 'update'])->name('update_book');

Route::post('/addtocart', [TransactionheaderController::class, 'addTransaction'])->name('add_to_cart');
Route::get('/viewCart', [Controller::class, 'viewCart']);
Route::get('/editBook/{id}', [Controller::class, 'editCartBook']);
Route::post('/editBook/update', [TransactionheaderController::class, 'updateTransaction'])->name('update_cart_book');
Route::post('/editBook/delete', [TransactionheaderController::class, 'deleteTransaction'])->name('delete_cart_book');
Route::post('/editBook/checkout', [TransactionheaderController::class, 'checkout'])->name('checkout_cart_book');

Route::get('/histories', [Controller::class, 'history']);
Route::get('/detail_history/{id}', [TransactionheaderController::class, 'historyDetail']);
