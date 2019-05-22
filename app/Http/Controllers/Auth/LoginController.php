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

use App\User;
use Socialite;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Socialite as SocialiteModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{


    use AuthenticatesUsers;


    protected $redirectTo = '/member';


    public function __construct()
    {
        $this->middleware('guest')->except(
            'logout',
            'redirectToProvider',
            'handleProviderCallback'
        );
    }

    protected function username(){

        return 'mobile';
    }


    public function login(){

        return view('auth.login');
    }


    public function redirectToProvider($app){

        return Socialite::driver($app)->redirect();
    }


    public function handleProviderCallback($app){

        $user = Socialite::driver($app)->user();
        if (Auth::check()) {
            // 已登录，绑定第三方账号
            if (Auth::user()->socialite()->whereApp($app)->exists()) {
                flash('当前用户已经绑定过该应用啦。', 'success');
            } else {
                Auth::user()->socialite()->save(new SocialiteModel([
                    'app' => $app,
                    'app_user_id' => $user->getId(),
                    'data' => serialize($user),
                ]));
                flash('绑定成功', 'success');
            }

            return redirect('member');
        }

        // 未登录，使用第三方账号登录
        $socialite = SocialiteModel::whereApp($app)->whereAppUserId($user->getId())->first();
        DB::beginTransaction();
        try {
            $userId = optional($socialite)->user_id ?? 0;
            if (! $userId) {
                // 创建用户
                $localUser = User::createUser($user->getNickname(), $user->getAvatar());
                // 绑定socialite
                $socialite = $localUser->bindSocialite($app, $user);
                $userId = $localUser->id;
            }
            // 尝试登录
            Auth::loginUsingId($userId, true);
            flash('登录成功', 'success');

            DB::commit();

            return redirect($this->redirectTo);
        } catch (\Exception $exception) {
            DB::rollBack();
            exception_record($exception);
            flash('系统错误');

            return back();
        }
    }
}
