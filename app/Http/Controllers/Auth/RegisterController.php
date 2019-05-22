<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{


    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => 'required|unique:users',
            'mobile' => 'bail|required|unique:users',
            'password' => 'bail|required|min:6|max:16|confirmed',
        ], [
            'nickname.required' => '请输入呢称',
            'nickname.unique' => '呢称已经存在',
            'mobile.required' => '请输入手机号',
            'mobile.unique' => '手机号已经存在',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不能小于6个字符',
            'password.max' => '密码长度不能超过16个字符',
            'password.confirmed' => '两次输入的密码不一致',
        ]);
    }

    public function showRegistrationForm(){

        return view('auth.register');
    }


    public function register(Request $request){

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }


    protected function guard(){

        return Auth::guard();
    }
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'] ?? User::randomNickName(),
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
            'is_active' => config('etuke.member.is_active_default'),
            'is_lock' => config('etuke.member.is_lock_default'),
        ]);
    }

//    public function register(Request $request)
//    {
//        $this->validator($request->all())->validate();
//
//        event(new Registered($user = $this->create($request->all())));
//
//        $this->guard()->login($user);
//
//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
//    }

}
