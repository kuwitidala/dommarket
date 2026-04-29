<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;


Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/catalog/{slug}', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{slug?}', [CatalogController::class, 'index'])->name('catalog');
Route::get('/load-more-products', [HomeController::class, 'loadMore']);
Route::get('/load-popular-products', [HomeController::class, 'loadPopular']);
Route::get('/load-popular-shops', [HomeController::class, 'loadPopularShops']);


//продукт
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


//отзывы
Route::post('/product/{id}/review', [ReviewController::class, 'store'])->middleware('auth');

//профиль
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('user.update');
});

Route::get('/regist', function () {
    return view('regist');
});
Route::get('/new', function () {
    return view('new');
});

Route::get('/order', function () {
    return view('order');
});

//регистрация
Route::get('/regist', [RegisterController::class, 'show'])->name('regist.show');
Route::post('/regist', [RegisterController::class, 'store'])->name('regist.store');

//магазин
Route::middleware('auth')->group(function () {
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
});
Route::post('/shop/update', [ShopController::class, 'update'])->name('shop.update');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/load-shop-products', [ShopController::class, 'loadProducts']);

//авторизация
Route::get('/auth', [LoginController::class, 'show'])->name('auth.show');
Route::post('auth', [LoginController::class, 'store'])->name('auth.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//фидбэк
Route::get('/feedback', [FeedbackController::class, 'showForm'])->name('feedback.show');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


Route::middleware('auth')->group(function () {

    Route::get('/shop', [ShopController::class, 'dashboard'])->name('shop.dashboard');

    Route::get('/shop/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/shop/product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/shop/product/{id}', [ProductController::class, 'deleteproduct'])->name('shop.product.delete');
    Route::get('/shop/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/shop/product/{id}', [ProductController::class, 'update'])->name('product.update');

});

//заказ
Route::middleware('auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
});

//корзинв
Route::middleware('auth')->group(function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});

//админка
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/shops', [AdminController::class, 'shops'])->name('admin.shops');

    Route::delete('/admin/products/{id}', [AdminController::class, 'deleteproduct'])->name('admin.products.delete');

    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/shops/{id}', [AdminController::class, 'deleteShop'])->name('admin.shops.delete');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');

});