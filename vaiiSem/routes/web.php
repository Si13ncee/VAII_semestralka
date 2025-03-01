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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/catalogue', [App\Http\Controllers\CatalogueController::class, 'index'])->name('catalogue');
Route::get('/search', [App\Http\Controllers\Admin\ProductController::class, 'search']);
Route::get('/product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('showProduct');
Route::post('/product/{productId}/review', [App\Http\Controllers\Admin\ProductController::class, 'storeReview'])->name('reviews.store');
Route::get('/product/{productId}/reviews', [App\Http\Controllers\ReviewController::class, 'loadReviews']);
Route::post('/cart/add/{productId}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::delete('/cart/remove/{itemId}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('cart.remove');
Route::put('/cart/update/{itemId}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/checkout/address', [App\Http\Controllers\CheckoutController::class, 'address'])->name('checkout.address');
Route::post('/checkout/review', [App\Http\Controllers\CheckoutController::class, 'review'])->name('checkout.review');



Route::middleware('auth')->post('/product/{productId}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::middleware('auth')->get('myOrders','App\Http\Controllers\OrderAdminController@listOrders')->name('myOrders');
Route::middleware('auth')->get('cancelOrder/{id}','App\Http\Controllers\OrderAdminController@cancelOrder')->name('cancelOrder');

 Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\FrontendController::class, 'index'])->name('dashboard');
    Route::get('products', 'App\Http\Controllers\Admin\ProductController@index');

    Route::get('orders', 'App\Http\Controllers\OrderAdminController@index');
    Route::get('viewOrder/{id}', 'App\Http\Controllers\OrderAdminController@viewOrder');
    Route::get('completeOrder/{id}', 'App\Http\Controllers\OrderAdminController@completeOrder');


    Route::get('categories', 'App\Http\Controllers\CategoryController@index');
    Route::get('newCategory', 'App\Http\Controllers\CategoryController@routeToAdd');
    Route::post('addNewCategory', 'App\Http\Controllers\CategoryController@insert');
    Route::get('editCategory/{id}', 'App\Http\Controllers\CategoryController@edit');
    Route::put('update-Category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
    Route::get('delete-Category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('deleteCategory');


    Route::get('add-product', 'App\Http\Controllers\Admin\ProductController@add');
    Route::post('insert-product','App\Http\Controllers\Admin\ProductController@insert');
    Route::get('edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class,'edit']);
    Route::put('update-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('updateProduct');
    Route::get('delete-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'deleteProduct'])->name('deleteProduct');
});
