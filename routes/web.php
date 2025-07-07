<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SellerController;
use App\Http\Livewire\Navbar;

use App\Models\Category;

Route::get('/', [ProductController::class, 'getAllCategories']);
Route::get('/category/{slug}', [ProductController::class, 'showByCategory'])->name('category.show');
Route::get('/product/{id}', [ProductController::class, 'detailProduct'])->name('detail.Product');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/store/{id}', [StoreController::class, 'detailStore']);

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

//view only
Route::get('/transaction', [TransactionController::class, 'viewTransaction'])->name('transaction');
// Route::get('/admin', function () {return view('cart');});

//SELLER
Route::get('/seller', function () {return view('seller.dashboard');
})->name('seller');
Route::get('/seller/products', [SellerController::class, 'getBySeller'])->name('products.bySeller');
// Tambah Produk
Route::get('/seller/product/create', [SellerController::class, 'create'])->name('products.create');
Route::post('/seller/product', [SellerController::class, 'store'])->name('products.store');

// Upload gambar hasil crop
// Route::post('/products/upload', [SellerController::class, 'upload'])->name('products.upload');


