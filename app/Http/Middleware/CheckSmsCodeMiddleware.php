<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Middleware;

use Closure;

class CheckSmsCodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $sessionKey = 'sms_'.$request->post('sms_captcha_key', '');
        $captcha = session($sessionKey);
        if (! $captcha || $captcha != $request->post('sms_captcha', '')) {
            flash('短信验证码错误');

            return back();
        }
        session()->forget($sessionKey);

        return $next($request);
    }
}
