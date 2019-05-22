<?php
/**
 * Created by PhpStorm.
 * User: wolf
 * Date: 2017/4/25
 * Time: 09:59
 */

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Storage;
use Imagick;
use Validator;
use Response;
class UploadFileController extends Controller
{


    public function poster()
    {

        $im = new Imagick();

        /* Read the image file */
        $im->readImage('D:/tu/1.jpg');
        $im->setImageCompressionQuality(70);
        /* Thumbnail the image ( width 100, preserve dimensions ) */
        $im->thumbnailImage(2000, null);

        /* Write the thumbail to disk */
        $im->writeImage('D:/tu/6.jpg');

        /* Free resources associated to the Imagick object */
        $im->destroy();
    }


    // 上传视频封面

    public function img()
    {
        Header("Content-type:  image/jpeg");/*告诉IE浏览器你做的程序是张图片*/
        $image = @imagecreatefromjpeg("/Users/wolf/lnmp/myprodect/myapp/toutiaogirls/storage/app/uploads/picture/20170425/foo.jpg");
        Imagejpeg($image, null, 90); /*压缩等级0-9，压缩后9最小，1最大*/
        imagedestroy($image);
    }


    public function setUserHead(Request $request)
    {

        $file = $request->file('file');
        $folder = date('Ymd');

        $filename = uniqid() . '.jpg';

        $path = 'poster/' . $folder;
        $savePath = $file->storeAs($path, $filename);

        if ($savePath) {
            //  $res_data=['code'=>0 , 'msg'=>'/poster/'.$folder.'/' . $name];
            // $res = self::uploadCos(storage_path('app') . '/' . $path . '/' . $filename, $folder . '/' . $filename, $folder);

//            $res_data = array('data'=> [
//                'local'=>$folder . '/' . $filename,
//                'url' =>$res['data']['source_url']
//            ],  'code' => 0, 'msg' => '上传成功');

            $res_data = array(
                'url' => config('app.local') . $savePath,
                'local' => $savePath,
                'code' => 0,
                'msg' => 'success'
            );
        } else {
            $res_data = ['code' => 1, 'msg' => '上传失败'];
        }
        return json_encode($res_data);
    }

    public function uploadAtlas(Request $request)
    {
        $file = $request->file('file');

        $folder = date('Ymd');

        $filename = uniqid() . '.jpg';

        $path = 'poster/' . $folder;
        $savePath = $file->storeAs($path, $filename);

        $data['aid'] = $request->input('aid');
        $data['img'] = $savePath;
        $data['created_at'] = time();
        //  return $data ;
        if ($savePath) {
            AlbumImg::insert($data);
            $res_data = array(
                'url' => config('app.local') . $savePath,
                'local' => $savePath,
                'code' => 0,
                'msg' => 'success'
            );
        } else {
            $res_data = ['code' => 1, 'msg' => '上传失败'];
        }
        return json_encode($res_data);
    }

    public function saveUserHead(Request $request, $str = 'head')
    {

        $folder = date('Ymd');
        $pic = $request->input('user_head');

        $base_arr = explode(',', $pic);

        if ($base_arr[1] != base64_encode(base64_decode($base_arr[1]))) {
            return json_encode(['code' => 0, 'msg' => '上传失败，请重新上传']);
        }

        $name = uniqid() . '.jpg';
        $filename = $str . '/' . $folder . '/' . $name;
        $save_path = Storage::put($filename, base64_decode($base_arr[1]));

        if ($save_path) {
            $res_data = ['code' => 0, 'msg' => $filename];
        } else {
            $res_data = ['code' => 1, 'msg' => '上传失败'];
        }
        return json_encode($res_data);
    }

    //上传最近照片
    public function userPoster(Request $request)
    {

        $str = $request->input('str') ? $request->input('str') : 'teacher';
        $file = $request->file('file');
        $folder = date('Ymd');

        $filename = uniqid() . '.jpg';
        $path = $str . '/' . $folder;
        $savePath = $file->storeAs($path, $filename);

        if ($savePath) {

            $res_data = array(
                'url' => '/uploads/' . config('app.local') . $savePath,
                'local' => $savePath,
                'code' => 0,
                'msg' => 'success'
            );
        } else {
            $res_data = ['code' => 1, 'msg' => '上传失败'];
        }
        return $res_data;
    }

    //指定上传目录
    public function userFilePhoto(Request $request, $str)
    {

        $file = $request->file('file');
        $folder = date('Ymd');

        $filename = uniqid() . '.jpg';
        $path = $str . '/' . $folder;
        $savePath = $file->storeAs($path, $filename);

        if ($savePath) {

            $res_data = array(
                'url' => '/upload/' . config('app.local') . $savePath,
                'local' => $savePath,
                'code' => 0,
                'msg' => 'success'
            );
        } else {
            $res_data = ['code' => 1, 'msg' => '上传失败'];
        }
        return json_encode($res_data);
    }

    public function uploadFiles(Request $request)
    {

        $input = $request->all();




        $rules = array(
            'file' => 'image|max:10000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $destinationPath = 'uploads'; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $fileName); // uploading file to given path

        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);

        }
    }
}