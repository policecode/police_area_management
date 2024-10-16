<?php

use App\Http\Controllers\Client\ChapersController AS ChapersClientController;
use App\Http\Controllers\Client\AuthorController AS AuthorClientController;
use App\Http\Controllers\Client\CategoriesController AS CategoriesClientController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\StoriesController AS StoriesClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
Route::group(['middleware' => ['throttle:30,1']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    Route::get('/tag/{tag_slug}', [CategoriesClientController::class, 'index'])->name('client.tag');
    
    Route::get('/story/get-list-chapers', [StoriesClientController::class, 'getListChapers'])->name('api.story.chapers');
    Route::get('/story/top-rating', [StoriesClientController::class, 'getTopViewStories'])->name('story.top-rating');
    Route::post('/story/star-rating', [StoriesClientController::class, 'ratingStar'])->name('story.rating');
    Route::get('/story/{story_slug}', [StoriesClientController::class, 'index'])->name('client.story');
    
    Route::post('/read/increase-views', [ChapersClientController::class, 'increaseViews'])->name('client.chaper.view');
    Route::get('/read/{story_slug}/{chaper_slug}', [ChapersClientController::class, 'index'])->name('client.chaper');
    
    Route::get('/author/{author_slug}', [AuthorClientController::class, 'index'])->name('client.author');
    Route::get('/test_client', function (Request $request) {
        dd($request->ip());
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/get-items', 'UserController@getItems')->name('getItems');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store')->name('store');
            Route::get('/edit/{user}', 'UserController@edit')->name('edit');
            Route::put('/update/{user}', 'UserController@update')->name('update');
            Route::delete('/delete/{user}', 'UserController@delete')->name('destroy');
        });

        // Route::resource('companies', 'CompanyController');
        // Route::resource('businesses', 'BusinessController');

        // TouristController
        // Route::get('tourists/export', 'TouristController@export')->name('tourists.export');
        // Route::post('tourists/import', 'TouristController@import')->name('tourists.import');
        // Route::resource('tourists', 'TouristController');

        // Stories
        Route::prefix('stories')->name('stories.')->group(function () {
            Route::get('/', 'StoriesController@index')->name('index');
            Route::get('/get-items', 'StoriesController@getItems')->name('getItems');
            Route::post('/', 'StoriesController@store')->name('store');
            Route::post('/update/{story}', 'StoriesController@update')->name('update');
            Route::delete('/{story}', 'StoriesController@destroy')->name('destroy');
        });
        // Route::resource('stories', 'StoriesController');

         // Chapers
         Route::get('/chapers/get-items', 'ChaperController@getItems')->name('chapers.getItems');
         Route::get('/chapers/{story}', 'ChaperController@index')->name('chapers.index');
         Route::post('/chapers/{story}', 'ChaperController@store')->name('chapers.store');
         Route::put('/chapers/{story}/{chaper}', 'ChaperController@update')->name('chapers.update');
         Route::delete('/chapers/{story}/{chaper}', 'ChaperController@destroy')->name('chapers.destroy');

        // Author
        // Route::get('/author/get-items', 'AuthorController@getItems')->name('author.getItems');
        Route::prefix('author')->name('author.')->group(function () {
            Route::get('/', 'AuthorController@index')->name('index');
            Route::get('/get-items', 'AuthorController@getItems')->name('getItems');
            Route::post('/', 'AuthorController@store')->name('store');
            Route::put('/{author}', 'AuthorController@update')->name('update');
            Route::delete('/{author}', 'AuthorController@destroy')->name('destroy');
        });

        // Category
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/get-items', 'CategoryController@getItems')->name('getItems');
            Route::post('/', 'CategoryController@store')->name('store');
            Route::put('/{category}', 'CategoryController@update')->name('update');
            Route::delete('/{category}', 'CategoryController@destroy')->name('destroy');
        });

        // Setting
        Route::get('/settings', 'SettingController@index')->name('setting.index');
        Route::post('/settings/page-one', 'SettingController@settingPageOne')->name('setting.pageOne');

        // Groups: Phân quyền
        Route::get('/groups', 'GroupController@index')->name('groups.index');
        Route::get('/groups/get-items', 'GroupController@getItems')->name('groups.getItems');
        Route::post('/groups', 'GroupController@store')->name('groups.store');
        Route::put('/groups/{group}', 'GroupController@update')->name('groups.update');
        Route::put('/groups/permission/{group}', 'GroupController@permission')->name('groups.permission');
        Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy');

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