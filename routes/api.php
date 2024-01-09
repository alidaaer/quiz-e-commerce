<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//will add it later
// Route::group(['middleware' => 'api_token'], function () {
// });

Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::post('/create-product', [ProductController::class, 'createProduct'])->name("create-product");
Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name("update-product");
Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name("delete-product");


Route::get('/get-Categories', [CategoryController::class, 'getCategories']);
Route::post('/create-category', [CategoryController::class, 'createCategory'])->name("create-category");
Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name("update-category");
Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name("delete-category");


