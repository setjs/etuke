<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Providers;

use Carbon\Carbon;
use App\Tool\Setting;
use App\Models\CourseComment;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\CourseCommentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // 中文
        Carbon::setLocale('zh');
        // 数据库
        Schema::defaultStringLength(191);
        // 模型事件
        CourseComment::observe(CourseCommentObserver::class);
        // OAuth路由
        Passport::routes();
        // 自定义配置同步
        $this->app->make(Setting::class)->sync();
        $this->registerViewNamespace();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * 注册视图.
     */
    protected function registerViewNamespace()
    {
        $this->loadViewsFrom(config('etuke.system.theme.path'), config('etuke.system.theme.use'));
    }
}
