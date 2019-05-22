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

class PhotoRequest extends FormRequest
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
    public function rules(){

        return [
            'title' => 'required',
            'amount'=>'required',
            'thumb' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
            'published_at' => 'required'
        ];
    }

    public function messages(){

        return [
            'title.required' => '请输入书名',
            'amount.required' => '请输入名字',
            'thumb.required' => '请上传封面',
            'seo_keywords.required' => '请输入SEO关键字',
            'seo_description.required' => '请输入SEO描述',
            'published_at.required' => '请选择上线日期'
        ];
    }

    public function fillData(){

        return [
            'title' => $this->post('title'),
            'album_id'=>$this->post('album_id'),
            'category_id'=>1,
            'amount' => $this->post('amount'),
            'tag_id' => $this->post('tag_id'),
            'platform'=>$this->post('platform'),
            'thumb' => $this->post('thumb'),
            'seo_keywords' => $this->post('seo_keywords'),
            'seo_description' => $this->post('seo_description'),
            'published_at' => $this->post('published_at'),
            'created_at'=>time()
        ];
    }
}
