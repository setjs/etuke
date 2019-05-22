<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Service;


use App\Http\Requests\Admin\ImageUploadRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Storage;
use Imagick;


class UploadController extends Controller{

    public function uploadImageHandle(ImageUploadRequest $request){

        $file = $request->fillData();

        $path = $file->store(config('etuke.upload.image.path'), config('etuke.upload.image.disk'));
        $url = Storage::disk(config('etuke.upload.image.disk'))->url($path);

        return ['path' => $path, 'url' => $url];

    }

    public function poster(ImageUploadRequest $request ){

        $im = new Imagick();
        $str = $request->str ? $request->str : 'teacher';
        $file = $request->file('file');
        $folder = date('Ymd');
        $filename = uniqid().'.jpg';
        $path = storage_path('app/'.$str.'/'.$folder.'/'.$filename);
        $path_name = storage_path('app/'.$str.'/'.$folder);
        $img_info= getimagesize($file);
        if (!is_dir($path_name)){
            mkdir(iconv("UTF-8", "GBK", $path_name) , 0755 , true);
        }

        $im->readImage( $file);


        /* Thumbnail the image ( width 100, preserve dimensions ) */

        if($img_info[0] >1280){

            $im->thumbnailImage( 1280, null );
            $im->setImageCompressionQuality(70);
        }else {
            $im->thumbnailImage( $img_info[0], null );
            $im->setImageCompressionQuality(80);
        }


        $im->writeImage( $path );


        $savePath = $im->destroy();

        if($savePath){
            $res_data = array(
                'url'=>'/uploads/'.$str.'/'.$folder.'/'.$filename,
                'local'=>$savePath,
                'code'=>0,
                'msg'=>'success'
            );
        }else{
            $res_data=['code'=>1 , 'msg'=>'上传失败'];
        }
        return json_encode($res_data);

    }

    public function posterArray(Request $request){


       // $upload = $this->get_upload_data('files');

        $file = $request->file('files');
        $str = $request->get('str');

        $result = self::getThumb($file[0] , $str);

       // return $result ;

        return ['files'=>array(['url'=>$result['url'],'deleteType'=>'DELETE' , 'str'=>$result['str'] , 'folder'=>$result['folder'], 'filename'=>$result['filename']])];



    }



    protected function getThumb($file , $str = 'str'  ){


        $im = new Imagick();

        $folder = date('Ymd');
        $filename = uniqid().'.jpg';
        $path = storage_path('app/'.$str.'/'.$folder.'/'.$filename);
        $path_name = storage_path('app/'.$str.'/'.$folder);
        $img_info= getimagesize($file);
        if (!is_dir($path_name)){
            mkdir(iconv("UTF-8", "GBK", $path_name) , 0755 , true);
        }

        $im->readImage( $file);


        /* Thumbnail the image ( width 100, preserve dimensions ) */

        if($img_info[0] >1280){

            $im->thumbnailImage( 1280, null );
            $im->setImageCompressionQuality(70);
        }else {
            $im->thumbnailImage( $img_info[0], null );
            $im->setImageCompressionQuality(80);
        }


        $im->writeImage( $path );


        $savePath = $im->destroy();

        if($savePath){
            $res_data = array(
                'url'=>'/uploads/'.$str.'/'.$folder.'/'.$filename,
                'local'=>$savePath,
                'code'=>0,
                'msg'=>'success',
                'str'=>$str,
                'folder'=>$folder,
                'filename'=>$filename
            );
        }else{
            $res_data=['code'=>1 , 'msg'=>'上传失败'];
        }
        return $res_data;
    }


    public function generate_response($content) {
         $content= array();

            $json = json_encode($content);
            $redirect = stripslashes($this->get_post_param('redirect'));
            if ($redirect && preg_match($this->options['redirect_allow_target'], $redirect)) {
                $this->header('Location: '.sprintf($redirect, rawurlencode($json)));
                return;
            }
            $this->head();
            if ($this->get_server_var('HTTP_CONTENT_RANGE')) {
                $files = isset($content[$this->options['param_name']]) ?
                    $content[$this->options['param_name']] : null;
                if ($files && is_array($files) && is_object($files[0]) && $files[0]->size) {
                    $this->header('Range: 0-'.(
                            $this->fix_integer_overflow((int)$files[0]->size) - 1
                        ));
                }
            }
            $this->body($json);

        return $content;
    }

    protected function header($str) {
        header($str);
    }
    protected function get_post_param($id) {
        return @$_POST[$id];
    }

    protected function get_server_var($id) {

        return @$_SERVER[$id];
    }
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }

    // 上传透底图片
    public function posterOpacity(ImageUploadRequest $request ){




        $image = new Imagick( storage_path('app/opacity/20190522/5ce4a9b10a6d7.jpg'));
        $image->borderImage(new \ImagickPixel("white"),1,1);
        $image->paintfloodfillimage('transparent',2000,NULL,0,0);
        $draw = new \ImagickDraw();
        $draw->color(0,0,imagick::PAINT_FLOODFILL);
        $image->drawImage($draw);
        $image->shaveImage(1,1);
        header("Content-Type: image/{$image->getImageFormat()}");
//        echo $image->getImageBlob( );
        $image->writeImage(storage_path('app/uploads/opacity/20190522/o.png'));
        $image->clear();
        $image->destroy();



//        $im = new Imagick();
//        $str = $request->str ? $request->str : 'teacher';
//        $file = $request->file('file');
//        $folder = date('Ymd');
//        $filename = uniqid().'.jpg';
//        $path = storage_path('app/'.$str.'/'.$folder.'/'.$filename);
//        $path_name = storage_path('app/'.$str.'/'.$folder);
//        $img_info= getimagesize($file);
//        if (!is_dir($path_name)){
//            mkdir(iconv("UTF-8", "GBK", $path_name) , 0755 , true);
//        }
//
//        $im->readImage( $file);
//
//
//        /* Thumbnail the image ( width 100, preserve dimensions ) */
//
//        if($img_info[0] >1280){
//
//            $im->thumbnailImage( 1280, null );
//            $im->setImageCompressionQuality(70);
//        }else {
//            $im->thumbnailImage( $img_info[0], null );
//            $im->setImageCompressionQuality(80);
//        }
//
//
//        $im->writeImage( $path );
//
//
//        $savePath = $im->destroy();
//
//        if($savePath){
//            $res_data = array(
//                'url'=>'/uploads/'.$str.'/'.$folder.'/'.$filename,
//                'local'=>$savePath,
//                'code'=>0,
//                'msg'=>'success'
//            );
//        }else{
//            $res_data=['code'=>1 , 'msg'=>'上传失败'];
//        }
//        return json_encode($res_data);

    }

    static function photo($path , $filename){

        $im = new Imagick();

        /* Read the image file */
        $im->readImage( $path );
        $im->setImageCompressionQuality(70);
        /* Thumbnail the image ( width 100, preserve dimensions ) */
        $im->thumbnailImage( 2000, null );

        /* Write the thumbail to disk */
        $im->writeImage( $filename );

        /* Free resources associated to the Imagick object */
         $im->destroy();

    }


}
