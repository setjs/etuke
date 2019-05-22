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

use App\Tool\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $config = [
            'etuke' => config('etuke'),
            'sms' => config('sms'),
            'services' => config('services'),
            'open'=>'open'
        ];



        return view('admin.setting.index', compact('config' ),[
            'pitch'=>'system'
        ]);
    }

    public function saveHandler(Request $request)
    {
        app()->make(Setting::class)->save($request);
        flash('修改成功', 'success');

        return back();
    }
}
