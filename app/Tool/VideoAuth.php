<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tool;

class VideoAuth
{
    public function handler(string $url, string $item)
    {
        return $this->{$item}($url);
    }

    protected function aliyun(string $url)
    {
        $privateKey = config('etuke.video.auth.aliyun.private_key', '');
        $path = parse_url($url, PHP_URL_PATH);
        $timestamp = time();
        $uid = 0;
        $rand = mt_rand(0, 1000000);
        $hash = md5("{$path}-{$timestamp}-{$rand}-{$uid}-{$privateKey}");

        return $url.'?auth_key='."{$timestamp}-{$rand}-{$uid}-{$hash}";
    }
}
