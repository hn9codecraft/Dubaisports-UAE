<?php

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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wishlist', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/delete/{productId}', [App\Http\Controllers\HomeController::class, 'removeWishlistItem'])->name('removeWishlistItem');
Route::get('/add-to-cart/{productId}', [App\Http\Controllers\HomeController::class, 'addToCart'])->name('addToCart');
Route::group(['as' => 'front.', 'namespace' => 'Front',  'middleware' => []], function () {
    
    Route::resource('/cart', 'CartController');
    Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');
    Route::get('/checkout/nomod/success', 'CheckoutController@nomodSuccess')->name('checkout.nomod.success');
    Route::resource('/checkout', 'CheckoutController');
    Route::resource('/orders', 'OrderController');
    
    Route::get('/quote', 'CMSPageController@getQuoteForm')->name('quote.get');
    Route::post('/quote', 'CMSPageController@storeQuoteForm')->name('quote.store');

    Route::post('products/delete', 'ProductController@delete')->name('products.delete');
    Route::resource('/products', 'ProductController');
    Route::get('/{category_group_slug}/{category_slug}', 'ProductController@index')->name('category.products');

    //--- Content pages
    Route::get('{slug}', 'CMSPageController@cmsPage');
});

Route::get('/nomod/processing/{id}', [App\Http\Controllers\Front\CheckoutController::class, 'nomodProcessingPage'])->name('nomod.processing');
Route::post('/nomod/check-status', [App\Http\Controllers\Front\CheckoutController::class, 'checkNomodPaymentStatus'])->name('nomod.checkStatus'); 

Route::get('/nomod/transaction/{id}', [App\Http\Controllers\Front\CheckoutController::class, 'getNomodTransactionById'])
    ->name('nomod.getTransaction');