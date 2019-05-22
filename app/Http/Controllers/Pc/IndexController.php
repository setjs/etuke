<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Pc;

use App\Models\DbModels;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\EmailSubscription;

class IndexController extends PcController{


    public function index(){


        $ad = DbModels::selectField('ads' , ['position'=>1]);
        $list = Photo::homeList();
        $tag = \Cache::get('tags');

        return view( 'web.index',[
            'ad'=>$ad,
            'list'=>$list,
            'tag'=>$tag
        ]);
    }

    public function detail($id){

        $line = Photo::photoLine($id);

        return view('web.detail.index',[
            'line'=>$line,
            'arr'=>unserialize($line->content)
        ]);
    }



    static public function getWeek($date){
        return date("w",strtotime($date));
    }
    static public function getOdd($arr){
        $odd = 0;
        foreach ($arr as $key=>$val){
            if($val % 2 == 1){
                $odd++;
            }

        }
        return $odd ;
    }
    static public function getSum($arr){
        $sum = 0;
        foreach ($arr as $key=>$val){
            $sum +=$val;
        }
        return $sum;
    }
    
    public function subscriptionHandler(Request $request)
    {
        EmailSubscription::saveFromRequest($request);

        return back();
    }
}
