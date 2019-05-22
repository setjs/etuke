<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin\Ajax;

use App\Tool\Tencent\Vod;
use App\Http\Controllers\Controller;

class TencentController extends Controller
{
    public function uploadSignature()
    {
        $signature = app()->make(Vod::class)->getUploadSignature();

        return compact('signature');
    }
}
