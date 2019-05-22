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

class PaymentController extends FrontendController
{
    /**
     * 支付回调.
     *
     * @param $payment
     *
     * @return mixed
     */
    public function callback($payment)
    {
        $payments = config('etuke.payment');
        if (! isset($payments[$payment])) {
            abort(404);
        }
        $handler = $payments[$payment]['handler'];

        return app()->make($handler)->callback();
    }
}
