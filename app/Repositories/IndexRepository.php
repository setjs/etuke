<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repositories;

use App\Models\Role;
use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class IndexRepository
{
    /**
     * 最新课程.
     *
     * @return mixed
     */
    public function recentPublishedAndShowCourses(){


        if (config('etuke.system.cache.status', -1) == 1) {
            return Cache::remember('index_recent_course', config('etuke.system.cache.expire', 60), function () {
                return Course::published()->show()->orderByDesc('created_at')->limit(3)->get();
            });
        }

        return Course::published()->show()->orderByDesc('created_at')->limit(3)->get();
    }

    /**
     * 订阅.
     *
     * @return mixed
     */
    public function roles()
    {

        if (config('etuke.system.cache.status', -1) == 1) {
            return Cache::remember('index_roles', config('etuke.system.cache.expire', 60), function () {
                return Role::show()->orderByDesc('weight')->get();
            });
        }

        return Role::show()->orderByDesc('weight')->limit(3)->get();
    }
}
