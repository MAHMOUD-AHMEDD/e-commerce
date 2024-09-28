<?php

use App\Http\Controllers\WebControllers\auth\LoginController;
use App\Http\Controllers\WebControllers\auth\RegisterController;
use App\Http\Controllers\WebControllers\ContactController;
use App\Http\Controllers\WebControllers\DashboardController;
use App\Http\Controllers\WebControllers\DeleteController;
use App\Http\Controllers\WebControllers\HomeController;
use App\Http\Controllers\WebControllers\LogoutController;
use App\Http\Controllers\WebControllers\OrdersController;
use App\Http\Controllers\WebControllers\ProductControllerResource;
use App\Http\Controllers\WebControllers\ReviewsController;
use App\Http\Controllers\WebControllers\UserController;
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
Route::get('/orders',[OrdersController::class,'index'])->middleware('auth');
Route::get('/orders/{id}',[OrdersController::class,'index'])->middleware('auth');
Route::get('checkout',[OrdersController::class,'checkout'])->name('checkout');
//Route::get('/orders/{id}',[OrdersController::class,'index']);
Route::get('products/orders/add/{product_id}', [OrdersController::class, 'add']);
Route::get('products/reviews/{product_id}',[ReviewsController::class,'add']);
Route::get('/products/category/{id}',[ProductControllerResource::class,'show_category']);
Route::get('/delete-item',[DeleteController::class,'delete']);
Route::get('/contact',[ContactController::class,'index']);
Route::post('/contact/save',[ContactController::class,'save'])->name('contact.save');
Route::post('/confirmation',[OrdersController::class,'confirmation'])->name('confirmation');
Route::get('/products/AddToFavourite/{id}',[ProductControllerResource::class,'addToFavourite'])->name('favourite.add');


Route::get('/productss/favourite',[UserController::class,'showFavourite']);


Route::group(['prefix'=>'/dashboard', 'middleware' => 'admin'],function () {
    Route::get('/users',[DashboardController::class,'users'])->name('dashboard.users');
    Route::get('/contacts',[DashboardController::class,'contacts'])->name('dashboard.contacts');
    Route::get('/orders',[DashboardController::class,'orders'])->name('dashboard.orders');
    Route::get('/edit-user/{id}',[DashboardController::class,'edit_user'])->name('dashboard.edit.user');
    Route::put('/update-user/{id}',[DashboardController::class,'update_user'])->name('dashboard.update.user');
    Route::get('/edit-contact/{id}',[DashboardController::class,'edit_contact'])->name('dashboard.edit.contact');
    Route::put('/update-contact/{id}',[DashboardController::class,'update_contact'])->name('dashboard.update.contact');
    // web.php
//    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.edit.user');
});
Route::get('/profile',[UserController::class , 'edit_user'])->name('profile.show');
Route::put('/profile/update',[UserController::class , 'update_user'])->name('profile.update');

