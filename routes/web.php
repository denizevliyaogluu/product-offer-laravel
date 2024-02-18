<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('homepage');
})->middleware('auth');



// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

//Register
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//products
Route::middleware(['role:user'])->group(function () {
    //homepage
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/create', [ProductController::class, 'createPost'])->name('products.create.post');
        Route::get('/update/{uniqid}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/update/{uniqid}', [ProductController::class, 'updatePost'])->name('products.update.post');
        Route::get('/delete/{uniqid}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/show/{uniqid}', [ProductController::class, 'show'])->name('products.show');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::get('/confirm-cart', [OrderController::class, 'confirmCart'])->name('orders.confirmCart');
    });
});


Route::prefix('productmanagement')->group(function () {
    Route::get('/', [ProductManagementController::class, 'index'])
        ->name('productmanagement.index')
        ->middleware('role:company');
});
