<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
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

// Route::get('/', function () {
//     return view('pages.home');
// });

// HOME
Route::get('/', 'HomeController@index')
    ->name('home');
// CATEGORY
Route::get('/categories', 'CategoryController@index')
    ->name('categories');

Route::get('/categories/{id}', 'CategoryController@details')
    ->name('categories-details');

// DETAIL
Route::get('/details/{id}', 'DetailController@index')
    ->name('detail');

Route::POST('/details/{id}', 'DetailController@add')
    ->name('detail-add');    

// SUCCESS

Route::POST('/checkout/callback', 'CheckoutController@callback')
    ->name('midtrans-callback');

Route::get('/success', 'CartController@success')
    ->name('success');


// AUTH
/* REGISTER */
Route::get('/register', 'Auth\RegisterController@register')
    ->name('register');

Route::get('/register/success', 'Auth\RegisterController@success')
    ->name('register-success');

/* lOGIN */
Route::get('/login', 'Auth\LoginController@login')
    ->name('login');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::group(['middleware' => ['auth']], function() {
    // CART
    Route::get('/cart', 'CartController@index')
        ->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')
        ->name('cart-delete');

    // checkout
    Route::POST('/checkout', 'CheckoutController@process')
        ->name('checkout');

    // Dashboar
    Route::get('/dashboard', 'DashboardController@index')
        ->name('dashboard');

    /* Dashboard Product */
    Route::get('/dashboard/product', 'DashboardProductController@index')
        ->name('dashboard-product');

    Route::get('/dashboard/product/create', 'DashboardProductController@create')
        ->name('dashboard-product-create');

    Route::POST('/dashboard/products', 'DashboardProductController@store')
        ->name('dashboard-product-store');
        
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')
        ->name('dashboard-product-details');

    Route::post('/dashboard/product/{id}', 'DashboardProductController@update')
        ->name('dashboard-product-update');

        /*  */
    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')
        ->name('dashboard-product-gallery-upload');

    Route::get('/dashboard/product/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
        ->name('dashboard-product-gallery-delete');
    /* Dashboard Transactions */
    Route::get('/dashboard/transactions', 'DashboardTransactionsController@index')
        ->name('dashboard-transactions');

    //  details
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionsController@details')
        ->name('dashboard-transactions-details');

    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionsController@update')
        ->name('dashboard-transaction-update');
    /* Dashboard Settings */
    Route::get('/dashboard/settings', 'DashboardSettingsController@store')
        ->name('dashboard-settings-store');

    /*  Account */
    Route::get('/dashboard/Account', 'DashboardSettingsController@account')
        ->name('dashboard-myAccount');

    Route::post('/dashboard/update/{redirect}', 'DashboardSettingsController@update')
        ->name('dashboard-myAccount-redirect');
    
});


// INI UNTUK DASHBOARD ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    
    ->group(function() {
        Route::get('/', 'DashboardController@index')
            ->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('transaction', 'TransactionController');
    });


Auth::routes();
