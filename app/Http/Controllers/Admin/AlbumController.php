<?php
/**
 * Created by PhpStorm.
 * User: forha
 * Date: 2019/4/14
 * Time: 0:07
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\AlbumRequest;
use App\Models\Albums;
use App\Models\DbModels;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function index(Request $request)
    {

//        dd(\Auth::guard('administrator')->user());
        $album = Albums::latest()->paginate($request->input('page_size', 90));

        return view('admin.album.index', compact('album'),[
            'pitch'=>'picture'
        ]);
    }

    public function create(){

        $tag = DbModels::getAll('tags');
        return view('admin.album.create',[
            'pitch'=>'picture',
            'tag'=>$tag,
            'value'=>''
        ]);
    }
//
    public function store(AlbumRequest $request){

        $result = Albums::create($request->fillData());

         if($result){
             return ['code'=>'200' , 'msg'=>'success'];
         }else{
             return ['code'=>'300' , 'msg'=>'error'];
         }

    }

    public function edit($id){
        $one = Albums::findOrFail($id);

        return view('admin.album.edit', compact('one'),[
            'pitch'=>'picture'
        ]);
    }

    public function update(Request $request){
        $id = $request->post('id');

        if($request->isMethod('post') && $request->ajax()){
            $thumb = $request->post('thumb' , '');
            $data['name']= $request->post('name');
            $data['title']= $request->post('title');
            $data['published_at']= $request->post('published_at');
            $data['desc'] = $request->post('desc');
            $data['seo_keywords']=$request->post('seo_keywords');
            $data['seo_description']=$request->post('seo_description');
            if($thumb){
                $data['thumb']=$thumb;
            }

            $data['updated_at']=time();

            $result = DbModels::updateData('albums' , $id , $data);

            if($result){
                return ['code'=>0 , 'msg'=>'success'];
            }else{
                return ['code'=>300 , 'msg'=>'error'];
            }

        }
    }
}