<?php

use App\Http\Controllers\aboutController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\detailController;
use App\Http\Controllers\pemasokController;
use App\Http\Controllers\pembelianController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\shopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stokController;
use App\Http\Controllers\thankyouController;
use Illuminate\Support\Facades\DB;

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
    $stok = DB::table('tbstok')->orderBy('created_at', 'desc')->take(3)->get();
    return view('welcome2')->with('stok', $stok);
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// route::get('/halamanadmin', [stokController::class, 'index'])->middleware('auth');
route::get('/shop', [shopController::class, 'index']);
route::get('/about', [aboutController::class, 'index']);
route::get('/blog', [blogController::class, 'index']);
route::get('/cart', [cartController::class, 'index'])->name('cart')->middleware('auth');
route::get('/checkout', [checkoutController::class, 'index'])->name('checkout')->middleware('auth');
route::get('/contact', [contactController::class, 'index']);
route::get('/services', [servicesController::class, 'index']);
route::get('/thankyou', [thankyouController::class, 'index']);
route::get('/detail/{id}', [detailController::class, 'index']);
route::post('/addToCart/{id}', [cartController::class, 'addToCart'])->name('addToCart')->middleware('auth');
Route::delete('/delete-cart-product/{id}', [CartController::class, 'deleteCart'])->name('delete')->middleware('auth');
Route::post('/update-quantity/{id}',[CartController::class, 'updatecart'])->name('update.quantity')->middleware('auth');
// Route::get('checkout', [checkoutController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::post('/checkout', [checkoutController::class, 'prosescheckout'])->middleware('auth');

route::get('/orders', [detailController::class, 'showOrders'])->middleware('auth');
Route::get('/orders/{nobukti}', [detailController::class, 'getOrderDetails'])->name('orders.details');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            $stok = DB::table('tbstok')->get();
            return view('welcome2')
            ->with('stok', $stok)
            ;
        })->name('dashboard');
    });

    Route::middleware(['auth:sanctum', 'verified', 'role:superadmin'])->group(function () {
        Route::get('/superadmin/dashboard', function () {
            return view('welcome');
        })->name('superadmin.dashboard');
    Route::resource('stok', stokController::class)->middleware('auth');
    Route::resource('pemasok', pemasokController::class)->middleware('auth');

    route::get('/penjualan', [penjualanController::class,'index'])->name('penjualan');
    Route::get('/penjualan/detail/{nobukti}', [penjualanController::class,'showDetail'])->name('detail-penjualan');

    Route::post('/update-status/{nobukti}', [penjualanController::class, 'updateStatus'])->name('update-status');
    Route::post('/reject-order/{nobukti}', [penjualanController::class, 'rejectOrder'])->name('reject-order');

    Route::get('/pembelian', [pembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/create', [pembelianController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian', [pembelianController::class, 'store'])->name('pembelian.store');
    Route::delete('/pembelian/{id}', [pembelianController::class, 'destroy'])->name('pembelian.destroy');
    Route::get('/pembelian/reset', [pembelianController::class, 'resetPurchaseNumber'])->name('pembelian.reset');
    });