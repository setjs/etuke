<?php
/**
 * User: 郭利俊 forhao@126.com
 * Date: 2019/4/17 13:42
 */

namespace App\Http\Controllers\Admin;

use App\Models\DbModels;
use App\Models\Photo;
use Illuminate\Http\Request;

class PlatformController extends Controller{

    public function index(){

        $list = DbModels::selectData('platform');

        return view('admin.platform.index', compact('list' ),[
            'pitch'=>'picture'
        ]);
    }

    public function create(){

        return view('admin.platform.create',[
            'pitch'=>'picture'
        ]);
    }
//
    public function store(Request $request){

        if ($request->isMethod('post') && $request->ajax()){

            $data['name']= $request->post('name');
            $data['title']= $request->post('title');
            $data['text']= $request->post('text');
            $data['thumb']= $request->post('thumb');

            $result = DbModels::insertData('platform', $data);
            if($result){
                return ['code'=>0 , 'msg'=>'success'];
            }else{
                return ['code'=>300, 'msg'=>300];
            }
        }


    }

    public function edit($id){
        $one = DbModels::selectOne('platform',$id);
        return view('admin.platform.edit', compact('one' ),[
            'pitch'=>'picture'
        ]);
    }


    public function update(Request $request){
        $id = $request->post('id');

        if($request->isMethod('post') && $request->ajax()){
            $thumb = $request->post('thumb' , '');
            $data['title']= $request->post('title');
            $data['published_at']= $request->post('published_at');
            $data['amount']=$request->post('amount' , '');
            $content=$request->post('p' , '');
            $data['content'] = $content?serialize($content):'';
            $data['seo_keywords']=$request->post('seo_keywords');
            $data['seo_description']=$request->post('seo_description');
            if($thumb){
                $data['thumb']=$thumb;
            }

            $data['updated_at']=time();

            $result = DbModels::updateData('photo' , $id , $data);

            if($result){
                return ['code'=>0 , 'msg'=>'success'];
            }else{
                return ['code'=>300 , 'msg'=>'error'];
            }

        }

    }

    public function destroys(Request $request){

        $id = $request->post('id');

        $result = DbModels::deleteData('photo' , $id);

        if($result){
            return ['code'=>0 , 'msg'=>'success'];
        }else{
            return ['code'=>300 , 'msg'=>'300'];
        }

    }
}