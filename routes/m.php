<?php

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

Route::get('/', 'Pc\IndexController@index')->name('index');
Route::get('/detail.html', 'Pc\DetailController@index')->name('detail');
Route::any('/service/create', 'Service\CaptchaController@create');

//Auth::routes();
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->middleware('sms.check');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showPage')->name('password.request');
Route::post('/password/reset', 'Auth\ForgotPasswordController@handler')->middleware('sms.check');
Route::post('/sms/send.html', 'Service\SmsController@send')->name('sms.send');

// 第三方登录
Route::get('/login/{app}', 'Auth\LoginController@redirectToProvider')->name('socialite');
Route::get('/login/{app}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/courses', 'Frontend\CourseController@index')->name('courses');
Route::get('/course/{id}/{slug}', 'Frontend\CourseController@show')->name('course.show');
Route::get('/course/{course_id}/video/{id}/{slug}', 'Frontend\VideoController@show')->name('video.show');

//Route::post('/subscription/email', 'Frontend\IndexController@subscriptionHandler')->name('subscription.email');

Route::get('/vip', 'Frontend\RoleController@index')->name('role.index');

Route::get('/faq', 'Frontend\FaqController@index')->name('faq');
Route::get('/faq/category/{id}', 'Frontend\FaqController@showCategoryPage')->name('faq.category.show');
Route::get('/faq/article/{id}', 'Frontend\FaqController@showArticlePage')->name('faq.article.show');

Route::get('/books', 'Frontend\BookController@index')->name('books');
Route::get('/book/{id}', 'Frontend\BookController@show')->name('book.show');

// 支付回调
Route::post('/payment/callback/{payment}', 'Frontend\PaymentController@callback')->name('payment.callback');

Route::group(['prefix' => '/member', 'middleware' => ['auth'], 'namespace' => 'Pc'], function () {

    Route::get('/', 'MemberController@index')->name('member');

    // 绑定手机号
    Route::get('/mobile/bind', 'MemberController@showMobileBindPage')->name('member.mobile.bind');
    Route::post('/mobile/bind', 'MemberController@mobileBindHandler')->middleware('sms.check');

    Route::get('/password_reset', 'MemberController@showPasswordResetPage')->name('member.password_reset');
    Route::post('/password_reset', 'MemberController@passwordResetHandler');
    Route::get('/avatar', 'MemberController@showAvatarChangePage')->name('member.avatar');
    Route::post('/avatar', 'MemberController@avatarChangeHandler');
    Route::get('/join_role_records', 'MemberController@showJoinRoleRecordsPage')->name('member.join_role_records');
    Route::get('/messages', 'MemberController@showMessagesPage')->name('member.messages');

/**********
    Route::get('/courses', 'MemberController@showBuyCoursePage')->name('member.courses');
    Route::get('/course/videos', 'MemberController@showBuyVideoPage')->name('member.course.videos');
******/

    Route::get('/orders', 'MemberController@showOrdersPage')->name('member.orders');
    Route::get('/books', 'MemberController@showBooksPage')->name('member.books');
    Route::get('/socialite', 'MemberController@showSocialitePage')->name('member.socialite');

    Route::post('/upload/image', 'UploadController@imageHandler')->name('upload.image');

    // 充值记录
    Route::get('/recharge/records', 'MemberController@showRechargeRecordsPage')->name('member.recharge_records');

    // 购买课程
    Route::get('/course/{id}/buy', 'CourseController@showBuyPage')->name('member.course.buy');
    Route::post('/course/{id}/buy', 'CourseController@buyHandler');

    // 购买视频
    Route::get('/video/{id}/buy', 'VideoController@showBuyPage')->name('member.video.buy');
    Route::post('/video/{id}/buy', 'VideoController@buyHandler');

    // 购买VIP
    Route::get('/vip/{id}/buy', 'RoleController@showBuyPage')->name('member.role.buy');
    Route::post('/vip/{id}/buy', 'RoleController@buyHandler');

    // 电子书
    Route::get('/book/{book_id}/chapter/{chapter_id}', 'BookController@chapter')->name('member.book.chapter');
    Route::get('/book/{id}/buy', 'BookController@showBuyPage')->name('member.book.buy');
    Route::post('/book/{id}/buy', 'BookController@buyHandler');

    // 收银台
    Route::get('/order/pay/success', 'OrderController@success')->name('order.pay.success');
    Route::get('/order/show/{order_id}', 'OrderController@show')->name('order.show');
    Route::any('/order/pay/{order_id}', 'OrderController@pay')->name('order.pay');
    Route::get('/order/pay/wechat/{order_id}', 'OrderController@wechat')->name('order.pay.wechat');
    Route::get('/order/pay/eshanghu/{order_id}', 'OrderController@eshanghu')->name('order.eshanghu.wechat');

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('/course/{id}/comment', 'AjaxController@courseCommentHandler')->name('ajax.course.comment');
        Route::post('/video/{id}/comment', 'AjaxController@videoCommentHandler')->name('ajax.video.comment');
        Route::get('/course/{id}/comments', 'AjaxController@courseCommentsPaginate')->name('ajax.course.comments');
        Route::get('/video/{id}/comments', 'AjaxController@videoCommentsPaginate')->name('ajax.video.comments');
    });
});