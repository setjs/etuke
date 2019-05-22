<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tool\Tencent;

use Illuminate\Support\Str;

class Vod
{
    protected $secretId;
    protected $secretKey;

    public function __construct()
    {
        $this->secretId = config('tencent.vod.secret_id');
        $this->secretKey = config('tencent.vod.secret_key');
    }

    /**
     * 获取上传签名.
     *
     * @return string
     */
    public function getUploadSignature()
    {
        $currentTime = time();
        $data = [
            'secretId' => $this->secretId,
            'currentTimeStamp' => $currentTime,
            'expireTime' => $currentTime + 86400,
            'random' => Str::random(12),
        ];
        $queryString = http_build_query($data);
        $sign = base64_encode(hash_hmac('sha1', $queryString, $this->secretKey, true).$queryString);

        return $sign;
    }
}
