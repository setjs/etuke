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

use App\Models\Role;
use App\Models\Order;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;

class RoleController extends PcController
{
    public function index()
    {
        $roles = Role::show()->orderByDesc('weight')->get();
        ['title' => $title, 'keywords' => $keywords, 'description' => $description] = config('etuke.seo.role_list');

        return v('web.role.index', compact('roles', 'title', 'keywords', 'description'));
    }

    public function showBuyPage($id)
    {
        $role = Role::show()->findOrFail($id);
        $title = sprintf('购买VIP《%s》', $role->name);

        return v('frontend.role.buy', compact('role', 'title'));
    }

    public function buyHandler(RoleRepository $repository, $id)
    {
        $role = Role::show()->findOrFail($id);
        $user = Auth::user();

        $order = $repository->createOrder($user, $role);
        if (! ($order instanceof Order)) {
            flash($repository->errors, 'error');

            return back();
        }

        flash('订单创建成功，请尽快支付', 'success');

        return redirect(route('order.show', $order->order_id));
    }
}
