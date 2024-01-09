<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/categories',[CategoryController::class, 'index']);
    Route::get('/products',[ProductController::class, 'index'])->name("all-products");
    Route::get('/update-product/{id}',[ProductController::class, 'updatePage']);
    Route::post('/update-product/{id}',[ProductController::class, 'update'])->name("update");

});


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [AuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('/', function () {
    return view('welcome');
});


