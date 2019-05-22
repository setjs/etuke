<?php


namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;

class SmsSendRequest extends BaseRequest{

    public function rules(){

        return [
            'captcha' => 'required',
            'mobile' => 'required',
            'method' => ['required', Rule::in(['password_reset', 'register', 'mobile_bind'])],
        ];
    }
//
    public function messages(){
//
        return [
            'captcha.required' => '请输入验证码',
//            'captcha.captcha' => '验证码错误',
            'mobile.required' => '请输入手机号',
            'method.*' => '参数错误',
        ];
    }

    public function fillData(){

        return [
            'mobile' => $this->input('mobile'),
            'captcha'=>$this->input('captcha'),
            'method' => implode('', array_map('ucfirst', explode('_', $this->input('method')))),
        ];
    }
}



