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

// Homepage route (this fixes the 404 on /)
Route::get('/', 'EthiochefController@ethiochef')->name('home');

// Authentication routes (login, register, etc.)
Auth::routes();

// Public routes
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/confirmation', 'EthiochefController@confirm')->name('confirmation');
Route::get('/ethiochef', 'EthiochefController@ethiochef')->name('ethiochef');
Route::get('detail/{food}', 'EthiochefController@detail')->name('detail');
Route::get('category/{category}', 'EthiochefController@category')->name('category');
Route::get('contact', 'EthiochefController@contact')->name('contact');
Route::post('contact/send', 'EthiochefController@message')->name('message.send');

// Authenticated admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', 'HomeController@index')->name('home');
    Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('/admin/categories', 'CategoriesController');
    Route::resource('/admin/foods', 'FoodsController');

    Route::get('admin/deleted-foods', 'FoodsController@trashed')->name('deleted-foods');
    Route::post('admin/foods/{food}', 'FoodsController@forceDelete')->name('force-delete');
    Route::get('admin/restore-food/{post}', 'FoodsController@restore')->name('restore-food');

    Route::get('admin/inbox', 'MiscellaneousController@inbox')->name('inbox');
});