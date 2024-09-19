<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductControllerResource;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ContactController;
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

Route::get('/', [ProductControllerResource::class,'index'])->middleware('auth');
//Route::get('auth/login',)
Route::group(['prefix'=>'/auth'],function (){
    Route::get('/register',[RegisterController::class,'index'])->name('register');
    Route::post('/register-post',[RegisterController::class,'save'])->name('auth.register');

    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login-post',[LoginController::class,'save'])->name('auth.login');
});
Route::get('/logout',[LogoutController::class,'logout_system'])->middleware('auth');


Route::resources([
    'products'=>ProductControllerResource::class
]);
Route::get('/orders/{id}',[OrdersController::class,'index']);
Route::get('products/orders/add/{product_id}', [OrdersController::class, 'add']);
Route::get('products/reviews/{product_id}',[ReviewsController::class,'add']);
Route::get('/products/category/{id}',[ProductControllerResource::class,'show_category']);
Route::get('/delete-item',[DeleteController::class,'delete']);
Route::get('/contact',[ContactController::class,'index']);
Route::post('/contact/save',[ContactController::class,'save'])->name('contact.save');
