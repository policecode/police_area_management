<?php

use App\Http\Controllers\Client\ChapersController AS ChapersClientController;
use App\Http\Controllers\Client\AuthorController AS AuthorClientController;
use App\Http\Controllers\Client\CategoriesController AS CategoriesClientController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\StoriesController AS StoriesClientController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
// 'throttle:30,1'
Route::group(['middleware' => []], function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    Route::get('/tag/{tag_slug}', [CategoriesClientController::class, 'index'])->name('client.tag');

    Route::get('/total-chapter/{slug_total}', [CategoriesClientController::class, 'getTotalChapter'])->name('client.total-chapter');
    
    Route::get('/story/get-list-chapers', [StoriesClientController::class, 'getListChapers'])->name('api.story.chapers');
    Route::get('/story/top-rating', [StoriesClientController::class, 'getTopViewStories'])->name('story.top-rating');
    Route::post('/story/star-rating', [StoriesClientController::class, 'ratingStar'])->name('story.rating');
    Route::get('/story/{story_slug}', [StoriesClientController::class, 'index'])->name('client.story');
    
    Route::post('/read/increase-views', [ChapersClientController::class, 'increaseViews'])->name('client.chaper.view');
    Route::get('/read/{story_slug}/{chaper_slug}', [ChapersClientController::class, 'index'])->name('client.chaper');
    
    Route::get('/author/{author_slug}', [AuthorClientController::class, 'index'])->name('client.author');
    Route::get('/test_client', function (Request $request) {
        dd($request->ips());
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'verified']], function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('can:admin.users.getItems');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserController@index')->name('index')->middleware('can:admin.users.getItems');
            Route::get('/get-items', 'UserController@getItems')->name('getItems')->middleware('can:admin.users.getItems');
            // Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store')->name('store')->middleware('can:admin.users.store');
            // Route::get('/edit/{user}', 'UserController@edit')->name('edit');
            Route::put('/update/{user}', 'UserController@update')->name('update')->middleware('can:admin.users.update');
            Route::delete('/delete/{user}', 'UserController@delete')->name('destroy')->middleware('can:admin.users.destroy');
        });

        // Route::resource('companies', 'CompanyController');
        // Route::resource('businesses', 'BusinessController');

        // TouristController
        // Route::get('tourists/export', 'TouristController@export')->name('tourists.export');
        // Route::post('tourists/import', 'TouristController@import')->name('tourists.import');
        // Route::resource('tourists', 'TouristController');

        // Stories
        Route::prefix('stories')->name('stories.')->group(function () {
            Route::get('/', 'StoriesController@index')->name('index')->middleware('can:admin.stpries.getItems');
            Route::get('/get-items', 'StoriesController@getItems')->name('getItems')->middleware('can:admin.stpries.getItems');
            Route::post('/', 'StoriesController@store')->name('store')->middleware('can:admin.stpries.store');
            Route::post('/update/{story}', 'StoriesController@update')->name('update')->middleware('can:admin.stpries.update');
            Route::delete('/{story}', 'StoriesController@destroy')->name('destroy')->middleware('can:admin.stpries.destroy');
        });
        // Route::resource('stories', 'StoriesController');

         // Chapers
         Route::get('/chapers/{story}', 'ChaperController@index')->name('chapers.index')->middleware('can:admin.chapers.getItems');
         Route::get('/chapers/get-items', 'ChaperController@getItems')->name('chapers.getItems')->middleware('can:admin.chapers.getItems');
         Route::post('/chapers/{story}', 'ChaperController@store')->name('chapers.store')->middleware('can:admin.chapers.store');
         Route::put('/chapers/{story}/{chaper}', 'ChaperController@update')->name('chapers.update')->middleware('can:admin.chapers.update');
         Route::delete('/chapers/{story}/{chaper}', 'ChaperController@destroy')->name('chapers.destroy')->middleware('can:admin.chapers.destroy');

        // Author
        // Route::get('/author/get-items', 'AuthorController@getItems')->name('author.getItems');
        Route::prefix('author')->name('author.')->group(function () {
            Route::get('/', 'AuthorController@index')->name('index')->middleware('can:admin.author.getItems');
            Route::get('/get-items', 'AuthorController@getItems')->name('getItems')->middleware('can:admin.author.getItems');
            Route::post('/', 'AuthorController@store')->name('store')->middleware('can:admin.author.store');
            Route::put('/{author}', 'AuthorController@update')->name('update')->middleware('can:admin.author.update');
            Route::delete('/{author}', 'AuthorController@destroy')->name('destroy')->middleware('can:admin.author.destroy');
        });

        // Category
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', 'CategoryController@index')->name('index')->middleware('can:admin.category.getItems');
            Route::get('/get-items', 'CategoryController@getItems')->name('getItems')->middleware('can:admin.category.getItems');
            Route::post('/', 'CategoryController@store')->name('store')->middleware('can:admin.category.store');
            Route::put('/{category}', 'CategoryController@update')->name('update')->middleware('can:admin.category.update');
            Route::delete('/{category}', 'CategoryController@destroy')->name('destroy')->middleware('can:admin.category.destroy');
        });

        // Setting
        Route::get('/settings', 'SettingController@index')->name('setting.index')->middleware('can:admin.setting.pageOne');
        Route::post('/settings/page-one', 'SettingController@settingPageOne')->name('setting.pageOne')->middleware('can:admin.setting.pageOne');

        // Groups: Phân quyền
        Route::get('/groups', 'GroupController@index')->name('groups.index')->middleware('can:admin.groups.getItem');
        Route::get('/groups/get-items', 'GroupController@getItems')->name('groups.getItems')->middleware('can:admin.groups.getItem');
        Route::post('/groups', 'GroupController@store')->name('groups.store')->middleware('can:admin.groups.store');
        Route::put('/groups/{group}', 'GroupController@update')->name('groups.update')->middleware('can:admin.groups.update');
        Route::put('/groups/permission/{group}', 'GroupController@permission')->name('groups.permission')->middleware('can:admin.groups.permission');
        Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy')->middleware('can:admin.groups.destroy');

    });
});

/**
 * Quản lý file, upload ảnh
 */
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Auth
Route::group(['namespace' => 'App\Http\Controllers\Auth', 'middleware' => []], function() {
    Route::get('/login', 'LoginController@showFormLogin')->name('auth.form_login');
    Route::post('/login', 'LoginController@login')->name('auth.login');
    Route::get('/logout', 'LoginController@logout')->name('auth.logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register_form');
    Route::post('/register', 'RegisterController@register')->name('auth.store');

    // Liên kết sẽ được gửi vào email của người đăng ký
    Route::get('/email/verify/{id}/{hash}', function (Request $request, $id) {
        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        $user->update();
        return redirect('/login')->with('msg', 'Kích hoạt tài khoản '.$user->email.' thành công');
    })->middleware(['signed'])->name('verification.verify');
    // Link thông báo vertify khi người dùng đăng ký tài khoản, chưa xác thực email
    Route::get('/email/verify', function () {
        $dataView = array(
            'title' => 'Vertify Email'
        );
        return view('auth.verify', $dataView);
    })->middleware('auth')->name('verification.notice');
    // Xử lý hành động gửi lại email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});