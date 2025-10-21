<?php

use App\Http\Controllers\AdminController;
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

use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'index'])->name('auth.page');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');


Route::get('/test', function(){
    return view('admin.showbook');
});

Route::get("/admin/books", [AdminController::class, 'getAllBooks']);

Route::get('/admin/users', [AdminController::class, 'getAllUsers']);

Route::post('/admin/books/add', [AdminController::class, 'addNewBook']);

Route::post('/admin/books/update/{id}', [AdminController::class, 'updateBook']);

Route::post('/admin/books/delete/{id}', [AdminController::class, 'deleteBook']);

Route::get("/admin/borrow-records", function(){
    return view('admin.borrow-record.show');
});

Route::get('/admin/borrow-details/{userId}', function($userId){
    return view('admin.borrow-record.detail', ['userId' => $userId]);
});