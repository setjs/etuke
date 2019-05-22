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

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required|unique:users',
            'mobile' => 'bail|required|unique:users',
            'password' => 'bail|required|min:6|max:16|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => '请输入呢称',
            'nickname.unique' => '呢称已经存在',
            'mobile.required' => '请输入手机号',
            'mobile.unique' => '手机号已经存在',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不能小于6个字符',
            'password.max' => '密码长度不能超过16个字符',
            'password.confirmed' => '两次输入的密码不一致',
        ];
    }

    public function filldata()
    {
        return [
            'nickname' => $this->post('nickname'),
            'mobile' => $this->post('mobile'),
            'password' => bcrypt($this->post('password')),
            'is_active' => config('etuke.member.is_active_default'),
            'is_lock' => config('etuke.member.is_lock_default'),
        ];
    }
}
