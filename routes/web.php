<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Livewire\Navbar;

use App\Models\Category;

Route::get('/', [ProductController::class, 'getAllCategories']);
Route::get('/category/{slug}', [ProductController::class, 'showByCategory'])->name('category.show');
Route::get('/store/{id}', [ProductController::class, 'showBySeller'])->name('store.show');
Route::get('/product/{id}', [ProductController::class, 'detailProduct'])->name('detail.Product');
Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/viewcheckout', [CheckoutController::class, 'viewCheckout'])->name('view.checkout');

//view only
Route::get('/transaction', [TransactionController::class, 'viewTransaction'])->name('transaction');
// Route::get('/admin', function () {return view('cart');});

//SELLER
Route::get('/seller/dashboard', [SellerController::class, 'sellerDashboard'])->name('seller.dashboard');
Route::get('/seller/products', [SellerController::class, 'sellerProduct'])->name('products.bySeller');
// Tambah Produk
Route::get('/seller/product/create', [SellerController::class, 'createProduct'])->name('products.create');
Route::post('/seller/product', [SellerController::class, 'storeProduct'])->name('products.store');
// Edit Produk
Route::get('/seller/products/{id}/edit', [SellerController::class, 'editProduct'])->name('products.edit');
Route::post('/seller/products/{id}/update', [SellerController::class, 'updateProduct'])->name('products.update');

// Delete Produk
Route::delete('/seller/product/destroy/{id}', [SellerController::class, 'destroyProduct'])->name('product.delete');

//variasi produk
Route::get('/seller/product/variant', function () {return view('seller.editvariantproduct');});


// Admin
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/seller', [AdminController::class, 'getAllSeller'])->name('admin.seller');
Route::get('/admin/buyer', [AdminController::class, 'getAllBuyer'])->name('admin.buyer');

//detail seller
Route::get('/admin/seller-{id}', [AdminController::class, 'getDetailSeller'])->name('admin.detailseller');
Route::get('/admin/seller/income-trans{id}', [AdminController::class, 'getDetailSeller'])->name('admin.incomingtransactionseller');
Route::get('/admin/seller/process-trans{id}', [AdminController::class, 'getDetailSeller'])->name('admin.transactionprocessedseller');
Route::get('/admin/seller/complete-trans{id}', [AdminController::class, 'getDetailSeller'])->name('admin.transactioncompleteseller');
Route::get('/admin/seller/withdrawal{id}', [AdminController::class, 'getDetailSeller'])->name('admin.withdrawalseller');
Route::get('/admin/seller/withdrawn{id}', [AdminController::class, 'getDetailSeller'])->name('admin.withdrawnseller');

//detail buyer
Route::get('/admin/buyer-{id}', [AdminController::class, 'getDetailBuyer'])->name('admin.detailbuyer');
Route::get('/admin/buyer/unpaid-trans{id}', [AdminController::class, 'getDetailBuyer'])->name('admin.incomingtransactionbuyer');
Route::get('/admin/buyer/process-trans{id}', [AdminController::class, 'getDetailBuyer'])->name('admin.transactionprocessedbuyer');
Route::get('/admin/buyer/complete-trans{id}', [AdminController::class, 'getDetailBuyer'])->name('admin.transactioncompletebuyer');

//Category
Route::get('/admin/category', [AdminController::class, 'getAllCategory'])->name('admin.category');
Route::post('/admin/category/add', [AdminController::class, 'addCategory'])->name('admin.categoryadd');
Route::put('/admin/category/{id}', [AdminController::class, 'editCategory'])->name('admin.categoryedit');
Route::delete('/admin/category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');

//masih untuk route saja
Route::get('/admin/tr', function () {
    return view('admin.daftar_transaksi');
})->name('tr');
