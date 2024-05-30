<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OfferController;
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
    if (auth()->user()->role === 'company') {
        return redirect()->route('productmanagement.index');
    } else {
        return redirect()->route('homepage');
    }
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
        Route::get('/show/{uniqid}', [ProductController::class, 'show'])->name('products.show');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::get('/confirm-cart', [OrderController::class, 'confirmCart'])->name('orders.confirmCart');
    });

    Route::post('/favorites/add', [FavoritesController::class, 'addToFavorites'])->name('favorites.add');
    Route::post('/favorites/remove', [FavoritesController::class, 'removeFromFavorites'])->name('favorites.remove');
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('wishlist.index');

    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');

});
Route::middleware(['role:company'])->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/create', [ProductController::class, 'createPost'])->name('products.create.post');
        Route::get('/update/{uniqid}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/update/{uniqid}', [ProductController::class, 'updatePost'])->name('products.update.post');
        Route::get('/delete/{uniqid}', [ProductController::class, 'delete'])->name('products.delete');
        Route::delete('/delete-image/{id}', [ProductController::class, 'deleteImage'])->name('delete.image');
    });
    Route::prefix('productmanagement')->group(function () {
        Route::get('/', [ProductManagementController::class, 'index'])
            ->name('productmanagement.index');
        Route::get('/product/{productId}/order-details', [ProductManagementController::class, 'showOrderDetails'])->name('product.order.details');
        Route::get('/product/{productId}/offer-details', [ProductManagementController::class, 'showOfferDetails'])->name('product.offers.details');
    });
});
Route::post('products/add-comment/{uniqid}', [ProductController::class, 'addComment'])->name('products.add.comment');

Route::post('/offers/store', [OfferController::class, 'store'])->name('offers.store');
