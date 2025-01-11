<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function(){

// to make the admin see all users 
 Route::get('/users', [App\Http\Controllers\API\AuthController::class, "index"])->name('index');
//  To make the seller add his store details
 Route::post('/Addstore', [App\Http\Controllers\storeController::class, "store"])->name('store.store');
//  To make the seller add new catergory to his store
 Route::post('/AddCategory', [App\Http\Controllers\categoryController::class, "store"])->name('category.store');
}); 


// Register & Login APIs
Route::controller(App\Http\Controllers\API\AuthController::class)->group(function(){
    //  to make defult customers register with role = 1
    Route::post('/register', 'register')->name('register');
    // to make the sellers register as sellers with role = 2
    Route::post('/sellerRegister', 'SellerRegister')->name('SellerRegister');
    // Login Api
    Route::post('/login', 'login')->name('login');
});
// to display all the products
Route::get('products', [App\Http\Controllers\productsController::class, "index"])->name('admin.index');
// to display all the stores
Route::get('/stores', [App\Http\Controllers\storeController::class, "index"])->name('store.index');
// To return all Categories
Route::get('/category', [App\Http\Controllers\categoryController::class, "index"])->name('category.index');
