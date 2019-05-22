<?php
/**
 * Created by PhpStorm.
 * User: wolf
 * Date: 2017/4/23
 * Time: 15:18
 */

namespace App\Http\Middleware;

use App\Models\DbModels;
use Closure;

use Illuminate\Http\Request;

class UserInfo{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){

        $uid  = $request->session()->get('uid');

        $url = $request->fullUrl();
        if(strpos($url , 'my') && empty($uid)){
            return redirect('user/login.html');
        }

        $user_info = $this->getUserInfo($uid);
//        $response->withCookie(cookie('name', 'value', $minutes));
        if($request->cookie('state')){
            $request->session()->put('uid', $request->cookie('state'));
        }

        view()->share(['user_info'=> $user_info]);
        $request->attributes->add(compact('user_info'));

        return $next($request);
    }


    static function getUserInfo($uid){

        $line = DbModels::selectField('users' , ['id'=>$uid] , ['id','nickname','mobile', 'avatar']);

        return $line ;

    }

}