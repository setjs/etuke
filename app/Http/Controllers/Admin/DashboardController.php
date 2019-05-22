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

use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller{
    public function index(){



        $todayRegisterUserCount = User::todayRegisterCount();

        $todayPaidNum = Order::todayPaidNum();

        $todayPaidSum = Order::todayPaidSum();

        return view('admin.index', compact(
            'todayRegisterUserCount',
            'todayPaidNum',
            'todayPaidSum'
        ),[
            'pitch'=>'dashboard'
        ]);
    }
}
