<?php
/**
 * User: 郭利俊 forhao@126.com
 * Date: 2019/4/17 13:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\PhotoRequest;
use App\Models\DbModels;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller{

    public function index($id){

        $list = Photo::where('album_id', $id)->latest()->paginate(30);

        return view('admin.photo.index', compact('list' , 'id'),[
            'pitch'=>'picture'
        ]);
    }

    public function lists(){
        $list = Photo::latest()->paginate(30);

        return view('admin.photo.list', compact('list'),[
            'pitch'=>'picture'
        ]);
    }

    public function create( $id){

        $platform = DbModels::getAll('platform');
        $tag = DbModels::getAll('tags');

        return view('admin.photo.create',compact('id' ),[
            'pitch'=>'picture',
            'platform'=>$platform,
            'tag'=>$tag
        ]);
    }
//
    public function store(PhotoRequest $request){

        $result = Photo::create($request->fillData());
        if($result){
            return ['code'=>0 , 'msg'=>'success'];
        }else{
            return ['code'=>300, 'msg'=>300];
        }
//        return $result ;

    }

    public function edit($id){
        $one = Photo::findOrFail($id);
        $platform = DbModels::getAll('platform');
        $tag = DbModels::getAll('tags');

        return view('admin.photo.edit', compact('one' , 'id'),[
            'pitch'=>'picture',
            'platform'=>$platform,
            'tag'=>$tag,
            'has'=>explode(',' , $one->tag_id)
        ]);
    }


    public function update(Request $request){
        $id = $request->post('id');

        if($request->isMethod('post') && $request->ajax()){
            $thumb = $request->post('thumb' , '');
            $data['title']= $request->post('title');
            $data['published_at']= $request->post('published_at');
            $data['amount']=$request->post('amount' , '');
            $data['platform']= $request->post('platform' , '');
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

    public function uploadView($id){

        $one = DbModels::selectOne('photo' , $id);
        return view('admin.photo.upload',[
            'id'=>$id,
            'pitch'=>'picture',
            'one'=>$one
        ]);
    }
    public function savePhoto(Request $request){
        $id = $request->post('id');
        $photo = $request->post('p') ;
        $data['content'] =serialize( $photo);
        $data['total'] = count($photo);
        $data['updated_at']=time();

        $result = DbModels::updateData('photo', $id , $data);
        if($result){
            return ['code'=>0 , 'msg'=>'success'];
        }else{
            return ['code'=>300 , 'msg'=>'300'];
        }

    }


    public function deleteImage(Request $request){
        $file = $request->get('str').'/'.$request->get('folder').'/'.$request->get('img');
        $file = storage_path('app/'.$file);
        unlink($file);
    }

}