<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\UserController;
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
Route::get('/home', function () {
    dd(Auth::guard());
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth_two']], function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/data', 'UserController@data')->name('data');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store')->name('store');
            Route::get('/edit/{user}', 'UserController@edit')->name('edit');
            Route::put('/update/{user}', 'UserController@update')->name('update');
            Route::delete('/delete/{user}', 'UserController@delete')->name('delete');
        });

        // Route::resource('categories', 'CategoryController');
        // Route::resource('courses', 'CourseController');
        // Route::resource('teachers', 'TeacherController');
        // Route::resource('lessons', 'LessonController');

        Route::resource('companies', 'CompanyController');
        Route::resource('businesses', 'BusinessController');
        Route::resource('tourists', 'TouristController');
    });
});

/**
 * Quản lý file, upload ảnh
 */
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Auth
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function() {
    Route::get('/login', 'LoginController@showFormLogin')->name('auth.form_login');
    Route::post('/login', 'LoginController@login')->name('auth.login');
    Route::get('/logout', 'LoginController@logout')->name('auth.logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register_form');

});