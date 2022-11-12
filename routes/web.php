<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    $feature = \App\Models\Product::where('is_featured', '1')->limit(4)->get();
    $new = \App\Models\Product::orderBy('id', 'desc')->limit(5)->get();
    return view('index')->with('feature', $feature)
        ->with('new', $new);
})->name('landing');

Auth::routes();

Route::group( ['middleware' => 'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::get('change_pass', [UserController::class, 'changePass'])->name('change-pass');
    Route::get('change_profile', [UserController::class, 'changeProfile'])->name('change-prof');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::post('/update-profile/{user}', [UserController::class, 'updateProfile'])->name('update-profile');
});

Route::get('/featured-products', [ProductController::class, 'viewFeatured'])->name('feat-products');
Route::get('/new-products', [ProductController::class, 'viewNew'])->name('new-products');

Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'updateCart'])->name('update.cart');
Route::get('cart-list', [ProductController::class, 'cartList'])->name('cart-list');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

