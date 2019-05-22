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

class AlbumRequest extends FormRequest{

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
    public function rules(){

        return [
            'name'=>'required',
            'thumb' => 'required',
            'desc' => 'required'
        ];
    }

    public function messages(){

        return [
            'name.required' => '请输入名字',
            'thumb.required' => '请上传封面',
            'desc.required' => '请输入剪短介绍'
        ];
    }

    public function fillData()
    {


        return [
            'name' => $this->post('name'),
            'thumb' => $this->post('thumb'),
            'desc' => $this->post('desc'),
            'tag_id' => $this->post('tag_id'),
            'published_at' => $this->post('published_at'),
            'created_at'=>time()
        ];
    }
}
