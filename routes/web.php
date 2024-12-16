<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login-done', 'login')->name('login.done');
    Route::get('/register', 'registerForm')->name('register.form');
    Route::post('/register-done', 'register')->name('register');
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->middleware(['isAdmin'])->group(function(){
        Route::get('/dashboard', [ProductController::class, 'adminshow'])->name('adminhome');
        Route::get('/addItem', [ProductController::class, 'createForm'])->name('createitem');
        Route::post('/added', [ProductController::class, 'create'])->name('createditem');
        Route::get('/update/{id}',[ProductController::class, 'update'])->name('update');
        Route::patch('/updated/{id} ',[ProductController::class, 'updated'])->name('updated');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory');
        Route::post('/createdcategory', [CategoryController::class, 'created'])->name('createdcategory');
    });
    Route::post('/logout',[Usercontroller::class, 'logout'])->name('logout');
    
    // Route::get('/products/{category?}', [ProductController::class, 'showByCategory']);
    
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/products', [ProductController::class, 'showAllProducts'])->name('products.all');
    Route::get('/categories', [ProductController::class, 'categoriesPage'])->name('categories');
    Route::get('/category/{id}', [ProductController::class, 'showByCategory'])->name('category.show');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
    
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/faktur', [CartController::class, 'faktur'])->name('faktur');
    Route::post('/save', [FakturController::class, 'save'])->name('save');
    Route::get('/history', [FakturController::class, 'history'])->name('history');
    Route::get('/detailinvoice/{id}', [FakturController::class, 'detailinvoice'])->name('detailinvoice');
    Route::get('/carts', [CartController::class, 'view'])->name('viewcart');

});


