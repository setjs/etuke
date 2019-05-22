<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_UNPAY = 1;
    const STATUS_PAYING = 5;
    const STATUS_PAID = 9;
    const STATUS_CANCELED = 7;

    const STATUS_TEXT = [
        self::STATUS_UNPAY => '未支付',
        self::STATUS_PAYING => '支付中',
        self::STATUS_PAID => '已支付',
        self::STATUS_CANCELED => '已取消',
    ];

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'charge', 'status', 'order_id', 'payment',
        'payment_method',
    ];

    protected $appends = [
        'status_text',
    ];

    public function getStatusTextAttribute()
    {
        return $this->statusText();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(OrderGoods::class, 'order_id');
    }

    /**
     * 订单状态文本.
     *
     * @return string
     */
    public function statusText(): string
    {
        return self::STATUS_TEXT[$this->status] ?? '';
    }

    /**
     * 获取订单的消息通知内容.
     *
     * @return string
     */
    public function getNotificationContent(): string
    {
        $goods = $this->goods;
        if ($goods->isEmpty()) {
            return '';
        }
        if ($goods->count() == 1) {
            return sprintf('您购买了%s', $goods[0]->getGoodsTypeText());
        }

        return sprintf('您购买了%s等%d件商品', $goods[0]->getGoodsTypeText(), $goods->count());
    }

    /**
     * 订单标题.
     *
     * @return string
     */
    public function getOrderListTitle(): string
    {
        $goods = $this->goods;
        if ($goods->isEmpty()) {
            return '';
        }
        if ($goods->count() == 1) {
            return $goods[0]->getGoodsTypeText();
        }

        $title = array_reduce($goods->toArray(), function ($item) {
            return $item->getGoodsTypeText().',';
        });

        return rtrim($title, ',');
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        if (! $status) {
            return $query;
        }

        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $keywords
     *
     * @return mixed
     */
    public function scopeKeywords($query, $keywords)
    {
        if (! $keywords) {
            return $query;
        }
        $memberIds = User::where('nickname', 'like', "%{$keywords}%")
            ->orWhere('mobile', 'like', "%{$keywords}%")
            ->select('id')
            ->pluck('id');

        return $query->whereIn('user_id', $memberIds);
    }

    /**
     * 获取今日已支付订单数量.
     *
     * @return mixed
     */
    public static function todayPaidNum()
    {
        return self::where('created_at', '>=', date('Y-m-d'))->status(self::STATUS_PAID)->count();
    }

    /**
     * 获取今日已支付总金额.
     *
     * @return mixed
     */
    public static function todayPaidSum()
    {
        return self::where('created_at', '>=', date('Y-m-d'))->status(self::STATUS_PAID)->sum('charge');
    }

    /**
     * 获取支付网关名.
     *
     * @return string
     */
    public function getPaymentText()
    {
        $payments = collect(config('etuke.payment'));
        $payment = $payments[$this->payment] ?? [];

        return $payment['name'] ?? '';
    }
}
