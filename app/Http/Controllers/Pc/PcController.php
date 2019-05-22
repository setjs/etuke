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

use App\Http\Controllers\BaseController;

class PcController extends BaseController{

    protected function success($message = '', $data = []){

        return [
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ];
    }
}
