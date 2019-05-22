<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tool\Payment\Alipay;

use Exception;
use App\Models\Order;
use Yansongda\Pay\Pay;
use App\Events\PaymentSuccessEvent;
use Illuminate\Support\Facades\Log;
use AppTool\Payment\Contract\Payment;
use App\Tool\Payment\Contract\PaymentStatus;

class Alipay implements Payment
{
    /**
     * 创建支付宝订单.
     *
     * @param Order $order
     *
     * @return PaymentStatus
     */
    public function create(Order $order): PaymentStatus
    {
        $payOrderData = [
            'out_trade_no' => $order->order_id,
            'total_amount' => $order->charge,
            'subject' => $order->getOrderListTitle(),
        ];
        $createResult = Pay::alipay(config('pay.alipay'))
                           ->{$order->payment_method}($payOrderData);

        return new PaymentStatus(true, $createResult);
    }

    public function query(Order $order): PaymentStatus
    {
    }

    public function callback()
    {
        $pay = Pay::alipay(config('pay.alipay'));

        try {
            $data = $pay->verify();
            Log::info($data);

            $order = Order::whereOrderId($data['out_trade_no'])->firstOrFail();

            event(new PaymentSuccessEvent($order));
        } catch (Exception $e) {
            exception_record($e);
        }

        return $pay->success();
    }

    /**
     * 支付URL.
     *
     * @param Order $order
     *
     * @return mixed|string
     */
    public static function payUrl(Order $order): string
    {
        return route('order.pay', [$order->order_id]);
    }
}
