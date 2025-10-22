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
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'index'])->name('auth.page');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/test', function(){
    return view('admin.showbook');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get("/admin/books", [AdminController::class, 'getAllBooks']);

    Route::get('/admin/users', [AdminController::class, 'getAllUsers']);

    Route::post('/admin/books/add', [AdminController::class, 'addNewBook']);

    Route::post('/admin/books/update/{id}', [AdminController::class, 'updateBook']);

    Route::post('/admin/books/delete/{id}', [AdminController::class, 'deleteBook']);

    Route::get("/admin/borrow-records", [AdminController::class, 'getBorrowRecords']);

    Route::post('/admin/approveBorrowRequest/{recordId}', [AdminController::class, 'approveBorrowRequest']);

    Route::post('/admin/finalizeBorrowRequest/{recordId}', [AdminController::class, 'finalizeBorrowRequest']);

    Route::post('/admin/return/{id}', [AdminController::class, 'returnBook']);

    Route::get('/admin/borrow-details/{userId}', [AdminController::class, 'getBorrowDetails']);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/books', [UserController::class, 'getAllBooks']);

    Route::post('/user/borrow/{id}', [UserController::class, 'borrowBook']);

    Route::post('/user/cancel-borrow/{id}', [UserController::class, 'cancelBorrow']);

    Route::get('/user/borrow-history', [UserController::class, 'getBorrowHistory']);

    Route::get('/user/profile', [UserController::class, 'getProfile']);

    Route::post('/user/profile', [UserController::class, 'updateProfile']);
});
