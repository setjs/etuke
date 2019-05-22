<?php
/**
 * User: 郭利俊 forhao@126.com
 * Date: 2019/4/26 15:59
 */
namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class IndexController extends Controller{

    public function index(){
        return view('open.index');
    }
}