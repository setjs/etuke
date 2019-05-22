<?php

// 后台登录
Route::get('login.html', 'Admin\AdminController@showLoginForm')->name('admin.login');
Route::post('login', 'Admin\AdminController@loginHandle');
Route::get('logout', 'Admin\AdminController@logoutHandle')->name('logout');
Route::any('service/create', 'Admin\CaptchaController@create');


Route::group(['namespace' =>'Admin' , 'middleware' => ['admin.login.check']], function () {
    // 主面板
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    // 图片上传
   // Route::post('/upload/poster', 'UploadController@userPoster')->name('upload.image');
    // 阿里云视频上传
    Route::post('/video/aliyun/create', 'AliyunVideoUploadController@createVideoToken')->name('video.upload.aliyun.create');
    Route::post('/video/aliyun/refresh', 'AliyunVideoUploadController@refreshVideoToken')->name('video.upload.aliyun.refresh');

    // 修改密码
//    Route::get('/password/update', 'AdminController@showEditPasswordForm')->name('edit.password');
    Route::put('/password/update.html', 'AdminController@editPasswordHandle');


    Route::group(['middleware' => 'admin.permission.check'], function () {
        // 管理员
        Route::get('/admins.html', 'AdminController@index')->name('admins.index');
        Route::get('/admins/create.html', 'AdminController@create')->name('admins.create');
        Route::post('/admins/create.html', 'AdminController@store');
        Route::get('/admins/edit/{id}.html', 'AdminController@edit')->name('admins.edit');
        Route::put('/admins/edit/{id}.html', 'AdminController@update');
        Route::get('/admins/destroy/{id}.html', 'AdminController@destroy')->name('admins.destroy');
        // 角色
        Route::get('/admin/role.html', 'AdminRoleController@index')->name('admin.role.index');
        Route::get('/admin/role/create.html', 'AdminRoleController@create')->name('admin.role.create');
        Route::post('/admin/role/create.html', 'AdminRoleController@store');
        Route::get('/admin/role/edit/{id}.html', 'AdminRoleController@edit')->name('admin.role.edit');
        Route::put('/admin/role/edit/{id}.html', 'AdminRoleController@update');
        Route::get('/admin/role/destroy/{id}.html', 'AdminRoleController@destroy')->name('admin.role.destroy');
        Route::get('/admin/role/permission/{id}.html', 'AdminRoleController@showSelectPermissionPage')->name('admin.role.permission');
        Route::post('/admin/role/permission/{id}.html', 'AdminRoleController@handlePermissionSave');

        // 权限
        Route::get('/admin/permission.html', 'AdminPermissionController@index')->name('admin.permission.index');
        Route::get('/admin/permission/create.html', 'AdminPermissionController@create')->name('admin.permission.create');
        Route::post('/admin/permission/create.html', 'AdminPermissionController@store');
        Route::get('/admin/permission/edit/{id}.html', 'AdminPermissionController@edit')->name('admin.permission.edit');
        Route::put('/admin/permission/edit/{id}.html', 'AdminPermissionController@update');
        Route::get('/admin/permission/destroy/{id}.html', 'AdminPermissionController@destroy')->name('admin.permission.destroy');

        // 广告管理

        Route::get('ad.html', 'AdController@index')->name('ad.index');
        Route::get('ad/create.html', 'AdController@create')->name('ad.create');
        Route::post('ad/create.html', 'AdController@store')->name('post.ad.create');
        Route::get('ad/edit/{id}.html', 'AdController@edit')->name('ad.edit');
        Route::post('ad/edit.html', 'AdController@update')->name('post.ad.edit');
        Route::post('ad/destroy.html', 'AdController@destroy')->name('ad.destroy');

        // 课程
        Route::get('/course.html', 'CourseController@index')->name('course.index');
        Route::get('/course/create', 'CourseController@create')->name('course.create');
        Route::post('/course/create.html', 'CourseController@store');
        Route::get('/course/edit/{id}', 'CourseController@edit')->name('course.edit');
        Route::put('/course/edit/{id}', 'CourseController@update');
        Route::get('/course/delete/{id}', 'CourseController@destroy')->name('course.destroy');

        // 视频
        Route::get('/video', 'CourseVideoController@index')->name('video.index');
        Route::get('/video/create', 'CourseVideoController@create')->name('video.create');
        Route::post('/video/create', 'CourseVideoController@store');
        Route::get('/video/{id}/edit', 'CourseVideoController@edit')->name('video.edit');
        Route::put('/video/{id}/edit', 'CourseVideoController@update');
        Route::get('/video/{id}/delete', 'CourseVideoController@destroy')->name('video.destroy');

        // 充值
        Route::get('/recharge', 'RechargeController@index')->name('recharge');
        Route::get('/recharge/export', 'RechargeController@exportToExcel')->name('recharge.export');

        // 订单
        Route::get('/orders', 'OrderController@index')->name('orders');

        // 会员
        Route::get('/member', 'MemberController@index')->name('member.index');
        Route::get('/member/{id}/show', 'MemberController@show')->name('member.show');
        Route::get('/member/create', 'MemberController@create')->name('member.create');
        Route::post('/member/create.html', 'MemberController@store')->name('member.post');

        // 公告
        Route::get('/announcement', 'AnnouncementController@index')->name('announcement.index');
        Route::get('/announcement/create', 'AnnouncementController@create')->name('announcement.create');
        Route::post('/announcement/create', 'AnnouncementController@store');
        Route::get('/announcement/{id}/edit', 'AnnouncementController@edit')->name('announcement.edit');
        Route::put('/announcement/{id}/edit', 'AnnouncementController@update');
        Route::get('/announcement/{id}/delete', 'AnnouncementController@destroy')->name('announcement.destroy');

        // 用户角色
        Route::get('role.html', 'RoleController@index')->name('role.index');
        Route::get('/role/create', 'RoleController@create')->name('role.create');
        Route::post('/role/create', 'RoleController@store');
        Route::get('/role/{id}/edit', 'RoleController@edit')->name('role.edit');
        Route::put('/role/{id}/edit', 'RoleController@update');
        Route::get('/role/{id}/delete', 'RoleController@destroy')->name('role.destroy');

        // 邮件群发
        Route::get('/subscription/email.html', 'SubscriptionController@create')->name('subscription.email');
        Route::post('/subscription_email', 'SubscriptionController@store');

        // 配置
        Route::get('/setting.html', 'SettingController@index')->name('setting.index');
        Route::post('/setting', 'SettingController@saveHandler');

        // FAQ分类
        Route::get('/faq/category', 'FaqCategoryController@index')->name('faq.category.index');
        Route::get('/faq/category/create', 'FaqCategoryController@create')->name('faq.category.create');
        Route::post('/faq/category/create', 'FaqCategoryController@store');
        Route::get('/faq/category/{id}/edit', 'FaqCategoryController@edit')->name('faq.category.edit');
        Route::put('/faq/category/{id}/edit', 'FaqCategoryController@update');
        Route::get('/faq/category/{id}/delete', 'FaqCategoryController@destroy')->name('faq.category.destroy');

        // FAQ文章
        Route::get('/faq/article', 'FaqArticleController@index')->name('faq.article.index');
        Route::get('/faq/article/create', 'FaqArticleController@create')->name('faq.article.create');
        Route::post('/faq/article/create', 'FaqArticleController@store');
        Route::get('/faq/article/{id}/edit', 'FaqArticleController@edit')->name('faq.article.edit');
        Route::put('/faq/article/{id}/edit', 'FaqArticleController@update');
        Route::get('/faq/article/{id}/delete', 'FaqArticleController@destroy')->name('faq.article.destroy');

        // 后台菜单
        Route::get('/menu.html', 'AdminMenuController@index')->name('menu.index');
        Route::get('/menu/create.html', 'AdminMenuController@create')->name('menu.create');
        Route::post('/menu/create.html', 'AdminMenuController@store')->name('menu.save');
        Route::get('/menu/edit/{id}.html', 'AdminMenuController@edit')->name('menu.edit');
        Route::put('/menu/edit/{id}.html', 'AdminMenuController@update');
        Route::post('/menu/delete.html', 'AdminMenuController@destroy')->name('menu.destroy');
        Route::post('/menu/change/save', 'AdminMenuController@saveChange')->name('menu.save_change');

        // 图书
        Route::get('/book.html', 'BookController@index')->name('book.index');
        Route::get('/book/create', 'BookController@create')->name('book.create');
        Route::post('/book/create', 'BookController@store');
        Route::get('/book/{id}/edit', 'BookController@edit')->name('book.edit');
        Route::put('/book/{id}/edit', 'BookController@update');
        Route::get('/book/{id}/delete', 'BookController@destroy')->name('book.destroy');

        // 图书章节
        Route::get('/book/chapter/{book_id}', 'BookChapterController@index')->name('book.chapter.index');
        Route::get('/book/chapter/create/{book_id}', 'BookChapterController@create')->name('book.chapter.create');
        Route::post('/book/chapter/create/{book_id}', 'BookChapterController@store');
        Route::get('/book/chapter/edit/{book_id}/{chapter_id}', 'BookChapterController@edit')->name('book.chapter.edit');
        Route::put('/book/chapter/edit/{book_id}/{chapter_id}', 'BookChapterController@update');
        Route::get('/book/delete/{book_id}/chapter/{chapter_id} ', 'BookChapterController@destroy')->name('book.chapter.destroy');

        // 友情链接
        Route::get('/link.html', 'LinkController@index')->name('link.index');
        Route::get('/link/create', 'LinkController@create')->name('link.create');
        Route::post('/link/create', 'LinkController@store');
        Route::get('/link/{id}/edit', 'LinkController@edit')->name('link.edit');
        Route::put('/link/{id}/edit', 'LinkController@update');
        Route::get('/link/{id}/delete', 'LinkController@destroy')->name('link.destroy');

        // AdFrom
        Route::get('/adfrom.html', 'AdFromController@index')->name('adfrom.index');
        Route::get('/adfrom/create', 'AdFromController@create')->name('adfrom.create');
        Route::post('/adfrom/create', 'AdFromController@store');
        Route::get('/adfrom/{id}/edit', 'AdFromController@edit')->name('adfrom.edit');
        Route::put('/adfrom/{id}/edit', 'AdFromController@update');
        Route::get('/adfrom/{id}/delete', 'AdFromController@destroy')->name('adfrom.destroy');
        Route::get('/adfrom/{id}/number', 'AdFromController@number')->name('adfrom.number');

        // 课程章节
        Route::get('/course/chapter/{course_id}.html', 'CourseChapterController@index')->name('coursechapter.index');
        Route::get('/course/chapter/create/{course_id}.html', 'CourseChapterController@create')->name('coursechapter.create');
        Route::post('/course/chapter/create/{course_id}.html', 'CourseChapterController@store');
        Route::get('/coursechapter/edit/{id}.html', 'CourseChapterController@edit')->name('coursechapter.edit');
        Route::put('/coursechapter/{id}/edit', 'CourseChapterController@update');
        Route::get('/coursechapter/{id}/delete', 'CourseChapterController@destroy')->name('coursechapter.destroy');

        // 首页导航
        Route::get('/nav.html', 'NavController@index')->name('nav.index');
        Route::get('/nav/create.html', 'NavController@create')->name('nav.create');
        Route::post('/nav/create', 'NavController@store');





        // 图库 专辑
        Route::get('/album.html', 'AlbumController@index')->name('album.index');
        Route::get('/album/create.html', 'AlbumController@create')->name('get.album.create');
        Route::post('/album/create.html', 'AlbumController@store')->name('post.album.create');
        Route::get('/album/edit/{id}.html', 'AlbumController@edit')->name('album.edit');
        Route::post('/album/edit.html', 'AlbumController@update')->name('post.album.edit');
        Route::post('/album/delete.html', 'AlbumController@destroy')->name('album.destroy');

        // 图库 图片
        Route::get('/photo.html', 'PhotoController@lists')->name('photo.list');
        Route::get('/photo/{album_id}.html', 'PhotoController@index')->name('photo.index');
        Route::get('/photo/create/{album_id}.html', 'PhotoController@create')->name('photo.create');
        Route::post('/photo/create.html', 'PhotoController@store')->name('post.photo.create');
        Route::get('/photo/edit/{album_id}.html', 'PhotoController@edit')->name('photo.edit');
        Route::post('/photo/edit.html', 'PhotoController@update')->name('post.photo.update');
        Route::post('photo/delete.html', 'PhotoController@destroys')->name('photo.destroy');
        Route::get('/photo/upload/{id}.html', 'PhotoController@uploadView')->name('photo.upload');
        Route::post('/photo/upload.html', 'PhotoController@savePhoto')->name('post.photo.save');
        Route::get('delete/image.html', 'PhotoController@deleteImage')->name('delete.image');

        // 标签
        Route::get('tags.html', 'TagsController@index')->name('tags.index');
        Route::post('tags/create.html', 'TagsController@store')->name('post.tags.create');
        Route::post('tags/edit.html', 'TagsController@update')->name('post.tags.update');
        Route::post('tags/delete.html', 'TagsController@destroys')->name('tags.destroy');

        // 平台
        Route::get('platform.html', 'PlatformController@index')->name('platform.index');
        Route::get('platform/create.html', 'PlatformController@create')->name('get.platform.create');
        Route::post('platform/create.html', 'PlatformController@store')->name('post.platform.create');
        Route::get('platform/edit/{id}.html', 'PlatformController@edit')->name('platform.edit');
        Route::post('platform/edit.html', 'PlatformController@update')->name('post.platform.edit');
        Route::post('platform/delete.html', 'PlatformController@destroy')->name('platform.destroy');


        // 双色球操作
        Route::get('/double/list.html', 'DoubleBallController@index')->name('double.index');
        Route::get('/double/create.html', 'DoubleBallController@created')->name('double.create');
        Route::post('/double/create.html', 'DoubleBallController@store')->name('double.store');
        Route::get('/double/edit/{id}.html', 'DoubleBallController@edit')->name('get.double.edit');
        Route::post('/double/edit.html', 'DoubleBallController@update')->name('post.double.update');
        Route::post('/double/destroy.html', 'DoubleBallController@destroy')->name('double.destroy');

    });

    // Ajax
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function () {
        // 获取课程章节
        Route::get('/course/{course_id}/chapters', 'CourseController@chapters')->name('ajax.course.chapters');
        // 获取上传密钥
        Route::get('/tencent/uploadSignature', 'TencentController@uploadSignature')->name('ajax.tencent.upload.signature');
    });
});

Route::group(['prefix' => '' ,'namespace' =>'Service'],function ($router){

//    Route::get('user/create', 'CaptchaController@create');
//    Route::post('user/sms.html' ,  'SmsController@sendSms');
//    Route::post('user/find/sms.html' ,  'SmsController@findPasswordSms');  // 找回密码
//    /********end*********/
//    /*******发送邮件********/
//    Route::get('mail/send','MailController@send');
//    Route::get('select/city.html','SelectCityController@getCityId');
    Route::post('upload/poster','UploadFileController@userPoster');
//    Route::any('upload/{str}.html','UploadFileController@userFilePhoto');
//
//    Route::any('upload/user/{str}.html','UploadFileController@saveUserHead');
    Route::get('cache.html' ,  'CacheController@updateTag');
    Route::get('get/cache.html' ,  'CacheController@getCache');
    Route::get('cache/{str}.html' ,  'CacheController@upCache');

    Route::post('poster.html' ,  'UploadController@poster'); //

    Route::post('poster/array.html' ,  'UploadController@posterArray');

    Route::post('posters.html' ,  'UploadController@posterOpacity');
});
