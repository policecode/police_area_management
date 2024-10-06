<?php

use App\Http\Controllers\Client\ChapersController AS ChapersClientController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/tag/{tag_slug}', function(Request $request, $tag_slug) {{
    dd($tag_slug);
}})->name('client.tag');

Route::get('/story/get-list-chapers', [StoriesClientController::class, 'getListChapers'])->name('api.story.chapers');
Route::post('/story/star-rating', [StoriesClientController::class, 'ratingStar'])->name('story.rating');
Route::get('/story/{story_slug}', [StoriesClientController::class, 'index'])->name('client.story');

Route::post('/read/increase-views', [ChapersClientController::class, 'increaseViews'])->name('client.chaper.view');
Route::get('/read/{story_slug}/{chaper_slug}', [ChapersClientController::class, 'index'])->name('client.chaper');

Route::get('/author/{author_slug}', function(Request $request, $author_slug) {{
    dd($author_slug);
}})->name('client.author');
Route::get('/test_client', function (Request $request) {
    dd($request->ip());
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth_two']], function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/get-items', 'UserController@getItems')->name('getItems');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store')->name('store');
            Route::get('/edit/{user}', 'UserController@edit')->name('edit');
            Route::put('/update/{user}', 'UserController@update')->name('update');
            Route::delete('/delete/{user}', 'UserController@delete')->name('delete');
        });

        // Route::resource('companies', 'CompanyController');
        // Route::resource('businesses', 'BusinessController');

        // TouristController
        // Route::get('tourists/export', 'TouristController@export')->name('tourists.export');
        // Route::post('tourists/import', 'TouristController@import')->name('tourists.import');
        // Route::resource('tourists', 'TouristController');

        // Stories
        Route::get('/stories/get-items', 'StoriesController@getItems')->name('stories.getItems');
        Route::post('/stories/update/{story}', 'StoriesController@update')->name('update-fix');
        Route::resource('stories', 'StoriesController');

         // Chapers
         Route::get('/chapers/get-items', 'ChaperController@getItems')->name('chapers.getItems');
         Route::get('/chapers/{story}', 'ChaperController@index')->name('chapers.index');
         Route::post('/chapers/{story}', 'ChaperController@store')->name('chapers.store');
         Route::get('/chapers/{story}/{chaper}', 'ChaperController@show')->name('chapers.show');
         Route::put('/chapers/{story}/{chaper}', 'ChaperController@update')->name('chapers.update');
         Route::delete('/chapers/{story}/{chaper}', 'ChaperController@destroy')->name('chapers.destroy');

        // Author
        Route::get('/author/get-items', 'AuthorController@getItems')->name('author.getItems');
        Route::resource('author', 'AuthorController');

        // Category
        Route::get('/category/get-items', 'CategoryController@getItems')->name('category.getItems');
        Route::resource('category', 'CategoryController');
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