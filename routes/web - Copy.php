<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
});

Auth::routes();




Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
  ],
  function () {
    // Admin Part
    Route::middleware(['auth'])->group(function () {
      Route::prefix('admin')->group(function () {
        // Amin routes
        Route::resource('admins', 'Admin\AdminController');
        Route::resource('roles', 'Admin\RoleController');
        Route::resource('categories', 'Admin\CategoryController');
        Route::resource('users', 'Admin\UserController');
        Route::resource('settings', 'Admin\SettingController');
      });
      // Default
      Route::get('/home', 'HomeController@index')->name('home');
    });
  }
);
