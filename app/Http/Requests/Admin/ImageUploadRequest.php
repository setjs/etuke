<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'bail|required|image',
        ];
    }

    public function messages()
    {
        return [
            'poster.required' => '请上传图片',
            'poster.image' => '请上传有效图片',
        ];
    }

    /**
     * @return \Illuminate\Http\UploadedFile
     */
    public function fillData()
    {
        return $this->file('poster');
    }
}
