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

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');
        $status = $request->input('status', null);
        $orders = Order::with(['user', 'goods'])
            ->status($status)
            ->keywords($keywords)
            ->latest()
            ->paginate($request->input('page_size', 10));

        return view('admin.order.index', compact('orders'),[
            'pitch'=>'finance'
        ]);
    }
}
