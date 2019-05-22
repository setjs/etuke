<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Pc;

use App\Models\Link;
use App\Events\AdFromEvent;
use Illuminate\Http\Request;
use App\Models\EmailSubscription;
use App\Repositories\IndexRepository;

class DetailController extends PcController{


    public function index(Request $request, IndexRepository $repository){


        return v(
            config('web.details', 'web.details'),
            compact('courses', 'roles', 'title', 'keywords', 'description', 'links')
        );
    }


}
