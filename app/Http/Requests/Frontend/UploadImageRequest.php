<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Frontend;

use Illuminate\Support\Facades\Storage;

class UploadImageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'file' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '请上传文件',
            'file.image' => '请上传图片文件',
        ];
    }

    public function filldata()
    {
        $disk = config('filesystems.default');
        $path = $this->file('file')->store('images', compact('disk'));

        return [$path, Storage::disk($disk)->url($path)];
    }
}
