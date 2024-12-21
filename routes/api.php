<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\auth\RegisterApiController;
use App\Http\Controllers\ApiControllers\auth\LoginApiController;
use App\Http\Controllers\ApiControllers\DeleteControllerApi;
use App\Http\Controllers\ApiControllers\ProductControllerApiResource;
use App\Http\Controllers\ApiControllers\ContactControllerApi;
use App\Http\Controllers\ApiControllers\OrdersControllerApi;
use App\Http\Controllers\ApiControllers\ReviewsControllerApi;
use App\Http\Controllers\ApiControllers\DashboardControllerApi;
use App\Http\Controllers\SoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/reg',SoController::class);


//Route::get('auth/login',)
Route::group(['prefix'=>'/auth'],function (){
    Route::post('/register', RegisterApiController::class);
    Route::post('/login', LoginApiController::class);
});
Route::post('/delete-item', DeleteControllerApi::class);

Route::resources([
    'ProductsApi'=>ProductControllerApiResource::class
]);
Route::post('contacts', [ContactControllerApi::class, 'save']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/orders', [OrdersControllerApi::class, 'index']);

    Route::post('/orders/add/{product_id}', [OrdersControllerApi::class, 'add']);

    Route::get('/orders/checkout', [OrdersControllerApi::class, 'checkout']);

    Route::get('/orders/confirmation', [OrdersControllerApi::class, 'confirmation']);

    Route::post('/reviews/add/{product_id}', [ReviewsControllerApi::class, 'add']);
});

Route::group(['prefix'=>'/dashboard', 'middleware' => 'admin','auth:sanctum'],function () {

    Route::get('/users', [DashboardControllerApi::class, 'users']);
    Route::get('/users/{id}/edit', [DashboardControllerApi::class, 'edit_user']);
    Route::put('/users/{id}', [DashboardControllerApi::class, 'update_user']);

    Route::get('/contacts', [DashboardControllerApi::class, 'contacts']);
    Route::get('/contacts/{id}/edit', [DashboardControllerApi::class, 'edit_contact']);
    Route::put('/contacts/{id}', [DashboardControllerApi::class, 'update_contact']);

    Route::get('/orders', [DashboardControllerApi::class, 'orders']);

});



