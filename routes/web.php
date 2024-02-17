<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
    return view('welcome');
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
Route::middleware(['auth'])->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/create', [ProductController::class, 'createPost'])->name('products.create.post');
    Route::get('/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/update/{id}', [ProductController::class, 'updatePost'])->name('products.update.post');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
});

//orders
Route::get('/orders/index', [OrderController::class,'index'])->name('orders.index');
Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/confirm-cart', [OrderController::class, 'confirmCart'])->name('orders.confirmCart');
