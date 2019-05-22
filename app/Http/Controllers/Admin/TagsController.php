<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;


use App\Models\DbModels;
use Illuminate\Http\Request;

class TagsController extends Controller{

    public function index(){

        $list = DbModels::selectData('tags');
        return view('admin.tags.index', compact('list') ,[
            'pitch'=>'picture'
        ]);
    }

    public function create(){

        return view('admin.tags.create',[
            'pitch'=>'picture'
        ]);
    }


    public function store(Request $request){

        if($request->isMethod('post') && $request->ajax()){

            $data['name']=$request->post('name');

            $has = DbModels::selectName('tags' , $data['name']);

            if($has){
                return ['code'=>100 , 'msg'=>'error'];
            }

            $data['created_at']=time();
            $result = DbModels::insertData('tags' , $data);
            if($result){
                return ['code'=>200 , 'msg'=>'success'];
            }else{
                return ['code'=>500 , 'msg'=>'error'];
            }
        }

    }

    public function destroys(Request $request){

        $id = $request->post('id');

        if($request->isMethod('post') && $request->ajax()){


            $result = DbModels::deleteData('tags' , $id);

            if($result){
                return ['code'=>200 , 'msg'=>'success'];
            }else{
                return ['code'=>500 , 'msg'=>'error'];
            }
        }


    }



    /**
     * 更换系统模板
     *
     * @param $templateId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setDefaultHandler($templateId)
    {


        $template = Template::findOrFail($templateId);
        if ($template->path == '' || $template->real_path == '') {
            flash('该模板数据不完整');

            return back();
        }

        if (! is_dir($template->path) || ! is_dir($template->real_path)) {
            flash('该模板文件不存在');

            return back();
        }

        app()->make(Setting::class)->save([
            'etuke.system.theme.use' => $template->name,
            'etuke.system.theme.path' => $template->path,
        ]);

        flash('模板更换成功', 'success');

        return back();
    }
}
