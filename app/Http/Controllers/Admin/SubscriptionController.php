<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;

use App\Jobs\DispatchEmailSubscriptionJob;
use App\Http\Requests\Admin\EmailSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function create()
    {
        return view('admin.subscription.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(EmailSubscriptionRequest $request)
    {
        [$title, $content] = $request->filldata();
        dispatch(new DispatchEmailSubscriptionJob($title, $content));
        flash('任务正在执行中，请耐心等待', 'success');

        return back();
    }
}
