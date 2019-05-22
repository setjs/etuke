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

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'avatar' => 'required',
            'nickname' => 'required|unique:users,nickname',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => '请上传头像',
            'nickname.required' => '请输入昵称',
            'nickname.unique' => '昵称已经存在',
            'mobile.required' => '请输入手机号',
            'mobile.unique' => '手机号已经存在',
            'password.required' => '请输入密码',
        ];
    }

    public function fillData(){

        return [
            'avatar' => $this->post('avatar'),
            'nickname' => $this->post('nickname'),
            'mobile' => $this->post('mobile'),
            'password' => bcrypt($this->post('password')),
            'is_active' => User::ACTIVE_YES,
        ];
    }
}
