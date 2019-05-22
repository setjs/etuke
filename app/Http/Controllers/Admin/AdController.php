<?php

/*
 * This file is part of the setjs/etuke
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;

use App\Models\DbModels;
use Illuminate\Http\Request;


class AdController extends Controller
{
    public function index()
    {
        $rows = DbModels::selectData('ads');

        return view('admin.ad.index', compact('rows'),[
            'pitch'=>'operated'
        ]);
    }

    public function create()
    {
        return view('admin.ad.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(Request $request){


        if($request->isMethod('post') && $request->ajax()){

            $data['title'] = $request->input('title');

            $item = $request->input('content');

            $data['content'] = serialize($item);
            $data['created_at'] = time();

            $result = DbModels::insertData('ads', $data);
            if($result){
                return json_encode(['code'=>0 , 'msg'=>'success']);
            }else{
                return json_encode(['code'=>1 , 'msg'=>'error']);
            }
        }


    }

    public function edit($id)
    {
        $one = DbModels::selectOne('ads' , $id);

        return view('admin.ad.edit', compact('one'),[
            'pitch'=>'operated'
        ]);
    }

    public function update(Request $request){
        $id = $request->post('id');

        if($request->isMethod('post') && $request->ajax()){
            $data['title'] = $request->input('title');

            $item = $request->input('content');

            $data['content'] = serialize($item);
            $data['updated_at'] = time();

            $result = DbModels::updateData('ads' , $id , $data);

            if($result){
                return ['code'=>0 , 'msg'=>'success'];
            }else{
                return ['code'=>300 , 'msg'=>'error'];
            }

        }
    }

    public function destroy(Request $request){

        $id = $request->post('id');

        $result = DbModels::deleteData('ads' , $id);

        if($result){
            return ['code'=>0 , 'msg'=>'success'];
        }else{
            return ['code'=>300 , 'msg'=>'300'];
        }

    }


}
