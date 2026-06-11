<?php

use App\Http\Controllers\Admin\ReplaceContentController;
use App\Http\Controllers\Client\AdSecurityController;
use App\Http\Controllers\Client\ChapersController as ChapersClientController;
use App\Http\Controllers\Client\AuthorController as AuthorClientController;
use App\Http\Controllers\Client\CategoriesController as CategoriesClientController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\StoriesController as StoriesClientController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\TopStoryController;
use App\Http\Controllers\Member\AudioController;
use App\Http\Controllers\Member\CommentController as MemberCommentController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\RegisterController as MemberRegisterController;
use App\Http\Controllers\Member\ResetPasswordController as MemberResetPasswordController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Member\ReportChapterController;
use App\Http\Controllers\Member\MemberActionController;
use App\Http\Controllers\Member\OrderController;
use App\Http\Controllers\Payment\SeePayController;
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
// Render audio
// Route::post('/text-to-speech', [AudioController::class, 'generateAudio']);
Route::get('/text-to-speech', [AudioController::class, 'generateAudio']);


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'verified']], function () {
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
            Route::get('/', 'StoriesController@index')->name('index')->middleware('can:admin.stories.getItems');
            Route::get('/get-items', 'StoriesController@getItems')->name('getItems')->middleware('can:admin.stories.getItems');
            Route::post('/', 'StoriesController@store')->name('store')->middleware('can:admin.stories.store');
            Route::post('/update/{story}', 'StoriesController@update')->name('update')->middleware('can:admin.stories.update');
            Route::delete('/{story}', 'StoriesController@destroy')->name('destroy')->middleware('can:admin.stories.destroy');
            Route::post('/handle-list-stories', 'StoriesController@handleListStories')->name('handleListStories')->middleware('can:admin.stories.handleListStories');
            Route::post('/handle-coppyright-stories', 'CoppyrightStoryController@handleCoppyrightStories')->name('handleCoppyrightStories')->middleware('can:admin.stories.handleCoppyrightStories');
            Route::get('/get-coppyright-story-items', 'CoppyrightStoryController@getItems')->name('getCoppyRightStoryItems')->middleware('can:admin.stories.getCoppyRightStoryItems');
        });
        // Route::resource('stories', 'StoriesController');

        // Chapers
        Route::get('/chapers/get-items', 'ChaperController@getItems')->name('chapers.getItems')->middleware('can:admin.chapers.getItems');
        Route::get('/chapers/{story}', 'ChaperController@index')->name('chapers.index')->middleware('can:admin.chapers.getItems');
        Route::post('/chapers/{story}', 'ChaperController@store')->name('chapers.store')->middleware('can:admin.chapers.store');
        Route::put('/chapers/{story}/{chaper}', 'ChaperController@update')->name('chapers.update')->middleware('can:admin.chapers.update');
        Route::delete('/chapers/{story}/{chaper}', 'ChaperController@destroy')->name('chapers.destroy')->middleware('can:admin.chapers.destroy');
        Route::delete('/chapers/{story}', 'ChaperController@destroyAll')->name('chapers.destroyAll')->middleware('can:admin.chapers.destroy');
        Route::post('/chapers/upload/{story}', 'ChaperController@uploadChapterByWord')->name('chapers.upload');

        // Replace Content
        Route::get('/replace-content/get-items', [ReplaceContentController::class, 'getItems'])->name('replaceContent.getItems')->middleware('can:admin.replaceContent.getItems');
        Route::post('/replace-content/replace-content/{story}', [ReplaceContentController::class, 'handleReplaceContent'])->name('replaceContent.replaceContent')->middleware('can:admin.replaceContent.replaceContent');
        Route::post('/replace-content/{story}', [ReplaceContentController::class, 'store'])->name('replaceContent.store')->middleware('can:admin.replaceContent.store');
        Route::delete('/replace-content/{replaceContent}', [ReplaceContentController::class, 'destroy'])->name('replaceContent.destroy')->middleware('can:admin.replaceContent.destroy');
        // Author
        // Route::get('/author/get-items', 'AuthorController@getItems')->name('author.getItems');
        Route::prefix('author')->name('author.')->group(function () {
            Route::get('/', 'AuthorController@index')->name('index')->middleware('can:admin.author.getItems');
            Route::get('/get-items', 'AuthorController@getItems')->name('getItems')->middleware('can:admin.author.getItems');
            Route::get('/{author}', 'AuthorController@show')->name('show')->middleware('can:admin.author.getItems');
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

        // Comments
        Route::prefix('comments')->name('comments.')->group(function () {
            Route::get('/', 'CommentsController@index')->name('index')->middleware('can:admin.comments.getItems');
            Route::get('/get-items', 'CommentsController@getItems')->name('getItems')->middleware('can:admin.comments.getItems');
            // Route::post('/', 'CommentsController@store')->name('store')->middleware('can:admin.comments.store');
            // Route::put('/{comments}', 'CommentsController@update')->name('update')->middleware('can:admin.comments.update');
            Route::delete('/{comments}', 'CommentsController@destroy')->name('destroy')->middleware('can:admin.comments.destroy');
        });

        // Star Ratings
        Route::prefix('star-ratings')->name('starRatings.')->group(function () {
            Route::get('/', 'StarRatingController@index')->name('index')->middleware('can:admin.starRatings.getItems');
            Route::get('/get-items', 'StarRatingController@getItems')->name('getItems')->middleware('can:admin.starRatings.getItems');
            // Route::post('/', 'StarRatingController@store')->name('store')->middleware('can:admin.starRatings.store');
            // Route::put('/{starRating}', 'StarRatingController@update')->name('update')->middleware('can:admin.starRatings.update');
            Route::delete('/{starRating}', 'StarRatingController@destroy')->name('destroy')->middleware('can:admin.starRatings.destroy');
        });

        // Setting
        Route::get('/settings', 'SettingController@index')->name('setting.index')->middleware('can:admin.setting.pageOne');
        Route::post('/settings/page-one', 'SettingController@settingPageOne')->name('setting.pageOne')->middleware('can:admin.setting.pageOne');

        // Groups: Phân quyền
        Route::get('/groups', 'GroupController@index')->name('groups.index')->middleware('can:admin.groups.getItems');
        Route::get('/groups/get-items', 'GroupController@getItems')->name('groups.getItems')->middleware('can:admin.groups.getItems');
        Route::post('/groups', 'GroupController@store')->name('groups.store')->middleware('can:admin.groups.store');
        Route::put('/groups/{group}', 'GroupController@update')->name('groups.update')->middleware('can:admin.groups.update');
        Route::put('/groups/permission/{group}', 'GroupController@permission')->name('groups.permission')->middleware('can:admin.groups.permission');
        Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy')->middleware('can:admin.groups.destroy');

        // Follow web: Theo dõi các thông số trang web
        Route::get('/visit-website', 'FollowWebController@index')->name('visitWebsite.index')->middleware('can:admin.visitWebsite.getItems');
        Route::get('/visit-website/get-items', 'FollowWebController@getItems')->name('visitWebsite.getItems')->middleware('can:admin.visitWebsite.getItems');

        // Pay Transaction: Tiền giao dịch nạp vào trang web
        Route::prefix('pay-transaction')->name('payTransaction.')->group(function () {
            Route::get('/', 'PayTransactionController@index')->name('index')->middleware('can:admin.payTransaction.getItems');
            Route::get('/get-items', 'PayTransactionController@getItems')->name('getItems')->middleware('can:admin.payTransaction.getItems');
            Route::delete('/{payTransaction}', 'PayTransactionController@destroy')->name('destroy')->middleware('can:admin.payTransaction.destroy');
        });

        // Order Chapter: mua chương truyện
        Route::prefix('order-chapter')->name('orderChapter.')->group(function () {
            Route::get('/', 'OrderChapterController@index')->name('index')->middleware('can:admin.orderChapter.getItems');
            Route::get('/get-items', 'OrderChapterController@getItems')->name('getItems')->middleware('can:admin.orderChapter.getItems');
            Route::delete('/{orderChapter}', 'OrderChapterController@destroy')->name('destroy')->middleware('can:admin.orderChapter.destroy');
        });
    });
});

/**
 * Quản lý file, upload ảnh
 */
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// Endpoint để ghi nhận click chuột
Route::post('/log-ad-click', [AdSecurityController::class, 'logClick'])->name('ads.log');

// Auth
Route::group(['namespace' => 'App\Http\Controllers\Auth', 'middleware' => []], function () {

    // Login và Register thông thường
    Route::get('/login', 'LoginController@showFormLogin')->name('auth.form_login');
    Route::post('/login', 'LoginController@login')->name('auth.login');
    Route::get('/logout', 'LoginController@logout')->name('auth.logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register_form');
    Route::post('/register', 'RegisterController@register')->name('auth.store');

    // Xử lý hành động gửi lại email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});


// 'throttle:30,1', visit_website
Route::group(['middleware' => ['throttle:30,1']], function () {
    Route::get('/test_client', function (Request $request) {
        dd($request->ips());
        // $respones = downloadImageFromUrl('https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482752AXp/anh-mo-ta.png', 'member/avatar/');
        // return response()->json([
        //     'status' => 1,
        //     'message' => 'Thành công',
        //     'data' => asset($respones)
        // ]);
    });

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('pages/huong-dan', [HomeController::class, 'huongdan'])->name('client.huong-dan');
    Route::get('pages/dieu-khoan-dich-vu', [HomeController::class, 'dieukhoandichvu'])->name('client.dieu-khoan-dich-vu');
    Route::get('pages/ban-quyen', [HomeController::class, 'banquyen'])->name('client.ban-quyen');
    Route::get('pages/chinh-sach-bao-mat', [HomeController::class, 'chinhsachbaomat'])->name('client.chinh-sach-bao-mat');
    Route::get('pages/lien-he', [HomeController::class, 'lienhe'])->name('client.lien-he');

    Route::get('/truyen-moi-cap-nhat', [TopStoryController::class, 'newUpdateStory'])->name('client.new-update');
    Route::get('/truyen-hot', [TopStoryController::class, 'hotStory'])->name('client.hot-story');
    Route::get('/truyen-full', [TopStoryController::class, 'fullStory'])->name('client.full-story');
    Route::get('/truyen-xem-nhieu/{view_slug}', [TopStoryController::class, 'viewStory'])->name('client.view-story');
    Route::get('/truyen-mua-nhieu', [TopStoryController::class, 'topPayStory'])->name('client.top-pay-story');

    Route::get('/search', [SearchController::class, 'index'])->name('client.search');
    Route::get('/super-search', [SearchController::class, 'superSearch'])->name('client.superSearch');
    Route::get('/api/super-search', [SearchController::class, 'searchItem'])->name('client.searchItem');

    Route::get('/tag/{tag_slug}', [CategoriesClientController::class, 'index'])->name('client.tag');
    Route::get('/author/{author_slug}', [AuthorClientController::class, 'index'])->name('client.author');
    Route::get('/total-chapter/{slug_total}', [CategoriesClientController::class, 'getTotalChapter'])->name('client.total-chapter');

    Route::get('/story/get-list-chapers', [StoriesClientController::class, 'getListChapers'])->name('api.story.chapers');
    Route::get('/story/top-rating', [StoriesClientController::class, 'getTopViewStories'])->name('story.top-rating');
    Route::get('/story/top-orders', [StoriesClientController::class, 'getTopOrderStories'])->name('story.top-orders');
    Route::post('/story/star-rating', [StoriesClientController::class, 'ratingStar'])->middleware(['auth', 'verified'])->name('story.rating');
    Route::get('/{story_slug}', [StoriesClientController::class, 'index'])->name('client.story');
    // Lấy 20 chương truyện đầu tiên gộp nội dung thành 1 trang
    Route::get('/dev-total-20-chapter/{story_slug}', [StoriesClientController::class, 'devTotal20Chapter'])->name('client.dev_total_20_chapter');

    // Route::get('/story/{story_slug}', [StoriesClientController::class, 'index']);

    Route::post('/read/increase-views', [ChapersClientController::class, 'increaseViews'])->name('client.chaper.view');
    Route::get('/read-api/{story_slug}/{chaper_slug}', [ChapersClientController::class, 'callChapterApi'])->name('client.api.chaper');
    Route::get('/{story_slug}/chuong-{chaper_position}', [ChapersClientController::class, 'index'])->middleware(['visit_website'])->name('client.chaper');
    

    // Route::get('/read/{story_slug}/{chaper_slug}', [ChapersClientController::class, 'index']);


});

// Member Auth
Route::group(['middleware' => ['throttle:30,1']], function () {
    // Login bằng mạng xã hội
    Route::get('/auth/google', [MemberLoginController::class, 'redirectSocialiteGoogle'])->name('auth.socialite.google');
    Route::get('/auth/google/callback', [MemberLoginController::class, 'loginSocialiteGoogle'])->name('auth.socialite.google.callback');

    // Login cho member
    Route::get('/member/login', [MemberLoginController::class, 'showFormLogin'])->name('member.form_login');
    Route::post('/member/login', [MemberLoginController::class, 'login'])->name('member.login');
    Route::get('/member/register', [MemberRegisterController::class, 'showFormRegister'])->name('member.form_register');
    Route::post('/member/register', [MemberRegisterController::class, 'register'])->name('member.store');
    // Route::get('/member/testmail', [MemberRegisterController::class, 'testmail']);
    // Chức năng quyên mật khẩu
    Route::get('/member/forgot-password', [MemberResetPasswordController::class, 'showFormForgotPassword'])->name('member.form_forgot_password');
    Route::post('/member/forgot-password', [MemberResetPasswordController::class, 'sendResetLinkEmail'])->name('member.send_reset_link_email');
    Route::get('/member/reset-password/{token}', [MemberResetPasswordController::class, 'showFormResetPassword'])->name('member.form_reset_password');
    Route::post('/member/reset-password', [MemberResetPasswordController::class, 'resetPassword'])->name('member.reset_password');

    // Liên kết sẽ được gửi vào email của người đăng ký
    Route::get('/email/verify/{remember_token}', [MemberRegisterController::class, 'emailVerify'])->name('verification.verify');

    // Link thông báo vertify khi người dùng đăng ký tài khoản, chưa xác thực email
    Route::get('/member/email/verify/{email}', [MemberRegisterController::class, 'repeatVetifyForm'])->name('verification.notice');
    Route::post('/member/email/verify/{email}', [MemberRegisterController::class, 'repeatVetify'])->name('verification.repeat');

    // Profile
    Route::get('/member/profile/{user_id}', [MemberProfileController::class, 'getProfile'])->name('member.profile');
    Route::get('/member/profile/{user_id}/votes', [MemberProfileController::class, 'getProfileVotes'])->name('member.profile.votes');
    Route::get('/member/profile/{user_id}/comments', [MemberProfileController::class, 'getProfileComments'])->name('member.profile.comments');

    Route::get('/member/profile-detail', [MemberProfileController::class, 'getProfileDetail'])->name('member.profile_detail');
    Route::get('/member/alert', [MemberProfileController::class, 'alert'])->name('member.alert');
    Route::get('/member/my-story', [MemberProfileController::class, 'mystory'])->name('member.mystory');
    Route::get('/member/my-story/favorites', [MemberProfileController::class, 'mystoryFavorite'])->name('member.mystory.favorites');
    Route::get('/member/my-story/copyright', [MemberProfileController::class, 'mystoryCopyright'])->name('member.mystory.copyright');
    Route::get('/member/gilf-code', [MemberProfileController::class, 'gilfcode'])->name('member.gilfcode');
    // =========================== Payment =================================
    Route::get('/member/payment', [SeePayController::class, 'index'])->name('member.payment.client');
    Route::post('/api/member/payment/qrcode', [SeePayController::class, 'getQrCode'])->name('member.payment.qrcode');
    Route::post('/api/member/payment/check-status', [SeePayController::class, 'checkPaymentStatus'])->name('member.payment.check_status');
    Route::post('/api/member/order-chapter', [ChapersClientController::class, 'buyChapter'])->name('member.payment.buy_chaper');
    Route::get('/api/member/total-buy-chapter/{story_id}', [ChapersClientController::class, 'getTotalBuyChapter'])->name('member.payment.total-buy-chapter');
    Route::post('/api/member/buy-combo-chapter', [ChapersClientController::class, 'handleBuyComboChapter'])->name('member.payment.buy-combo-chapter');

    // ======================= Lịch sử mua chương =======================
    Route::get('/member/my-story/history-orders', [OrderController::class, 'historyOrders'])->name('member.history_orders');
    Route::get('/member/my-story/history-payments', [OrderController::class, 'historyPayments'])->name('member.history_payments');

});

// Member Action
Route::group(['middleware' => ['throttle:20,1']], function () {
      
    // Comment
    Route::get('/api/member/list-comment', [MemberCommentController::class, 'getListComments']);
    Route::post('/api/member/post-comment', [MemberCommentController::class, 'postComment']);
    Route::post('/api/member/like-comment', [MemberCommentController::class, 'likeComment']);

    // Report Chapter
    Route::post('/api/member/report-chapter', [ReportChapterController::class, 'reportChapter']);

    // Upload avatar, banner
    Route::post('/api/member/upload-action/{action}', [MemberActionController::class, 'uploadAction']);
    // Update thông tin cá nhân
    Route::post('/api/member/update-profile', [MemberActionController::class, 'updateProfile']);
    Route::get('api/member/list-top-member', [MemberActionController::class, 'getTopMember']);

    // Handle story
    Route::post('/api/member/save-favorite-story', [MemberActionController::class, 'saveFavoriteStory']);
    Route::get('api/member/my-story', [MemberProfileController::class, 'callApiMyStory']);

  
    });
