<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TouristController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\StoriesController AS StoriesClientController;
use App\Http\Controllers\Client\ChapersController AS ChapersClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('test/import', [TouristController::class, 'import']);

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => []], function() {
    Route::prefix('manager')->group(function () {
        Route::prefix('stories')->group(function () {
            Route::get('/get-thumbnail', 'StoriesController@getthumbnail');
            Route::post('/tool-upload-story', 'StoriesController@toolUploadStory');
            Route::post('/tool-upload-chaper/{story}', 'StoriesController@toolUploadChaper');
            // Route::get('/auto-convert-story-description', 'StoriesController@autoConvertDescriptionToHtml');
            Route::get('/auto-convert-total-chapter', 'StoriesController@autoConvertTotalChapter');

        });
    });
});
Route::get('search/keyword', [HomeController::class, 'searchKeyword']);

// Route::post('/story/star-rating', [StoriesClientController::class, 'ratingStar']);
Route::post('/read/increase-views', [ChapersClientController::class, 'increaseViews']);

