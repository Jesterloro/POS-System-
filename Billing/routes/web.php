<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierAuthController;
use App\Http\Controllers\TransactionHistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sale/sample', function () {
    return view('sample');
});


// Route::get('/product', [Productcontroller::class, 'index'])-> name('product.index');
// Route::get('/product/create', [Productcontroller::class, 'create'])-> name('product.create');
// Route::post('/product', [Productcontroller::class, 'store'])-> name('product.store');
Route::resource('product', ProductController::class);


// for sales
Route::post('/product/import-sales/{id}', [ProductController::class, 'importSales'])->name('product.import_sales');
// routes/web.php



// Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
// Route::delete('sale/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');

// for search routes
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
// Route::get('/product', [SalesController::class, 'index'])->name('product.index');

// Route::resource('sale', ProductController::class);


Route::get('/sales-data', [ProductController::class, 'getSalesData'])->name('sales.data');





// clear all sales
Route::post('/sales/clearAll', [SalesController::class, 'clearAll'])->name('sales.clearAll');






Route::post('/transaction-history', [TransactionHistoryController::class, 'store'])->name('transactionHistory.store');
Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transactionHistory.index');
// routes/web.php
Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction.history');

// routes/web.php

Route::get('/transactions', [TransactionHistoryController::class, 'showTransactionHistory'])->name('transaction.history');


// routes for admin routes


Route::get('/cashier-login', [CashierAuthController::class, 'showLoginForm'])->name('cashier.login.form');
Route::post('/cashier-login', [CashierAuthController::class, 'login'])->name('cashier.login');
Route::post('/cashier-logout', [CashierAuthController::class, 'logout'])->name('cashier.logout');





Route::get('/cashier-register', [CashierAuthController::class, 'showRegisterForm'])->name('cashier.register.form');
Route::post('/cashier-register', [CashierAuthController::class, 'register'])->name('cashier.register');

Route::get('/cashier-dashboard', function () {
    if (!Session::has('cashier_id')) {
        return redirect('/cashier-login');
    }

    return view('cashier.dashboard');
});


// for handeling massive data on items
Route::get('/products/data', 'ProductController@getProductData')->name('products.data');





Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');


Route::get('/settings', function () {
    return view('settings'); // points to resources/views/settings.blade.php
})->name('settings');

// // web.php
Route::get('/settings/stock-status', [ProductController::class, 'getStockStatus'])->name('settings.stock-status');



// for the product quantity and sales to edit
Route::post('/products/{id}/update-quantity', [ProductController::class, 'updateQuantity'])->name('product.updateQuantity');
Route::get('/products/search/{barcode}', [ProductController::class, 'searchByBarcode'])->name('product.searchByBarcode');
Route::post('/sales/store', [SalesController::class, 'store']);
Route::delete('/sales/destroy/{id}', [SalesController::class, 'destroy']);


// Update product stock after sale
Route::post('/sales/{sale}/update-quantity', [SalesController::class, 'updateQuantity'])->name('sales.updateQuantity');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');


Route::get('/get-last-reference-id', [TransactionHistoryController::class, 'getLastReferenceID']);


// discounted price
Route::post('/product/update-price', [ProductController::class, 'updatePrice']);
Route::post('/product/update-price', [ProductController::class, 'updatePriceWithDiscount']);
Route::post('/product/update-price', [ProductController::class, 'updatePrice'])->name('product.updatePrice');
