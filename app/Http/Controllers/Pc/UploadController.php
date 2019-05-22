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

use App\Http\Requests\Frontend\UploadImageRequest;

class UploadController extends FrontendController
{
    public function imageHandler(UploadImageRequest $request)
    {
        [$path, $url] = $request->filldata();

        return $this->success('', $url);
    }
}
