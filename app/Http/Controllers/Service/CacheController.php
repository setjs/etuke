<?php


namespace App\Http\Controllers\Service;


use App\Http\Controllers\Controller;
use App\Models\DbModels;
use Cache ;

class CacheController extends Controller{

    public function updateTag(){
        $list = DbModels::getAllData('tags' , ['id', 'name'])->toArray();
//        Cache::remember('tags',365*3600*24, function() {
//
//            $list = DbModels::getAllData('tags' , ['id', 'name']);
//            return $list->toArray();
//
//        });

        Cache::forever('tags' , $list);
    }


    public function getCache(){

        $tag = Cache::get('tags');
        dd( $tag);
    }


    public function upCache($str){


       $result = Cache::forget($str);


        if($result){
            return json_encode(['code'=>0 , 'msg'=>'success']);
        }else{
            return json_encode(['code'=>1 , 'msg'=>'error']);
        }

    }

}