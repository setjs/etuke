<?php
/**
 * Created by PhpStorm.
 * User: wolf
 * Date: 2017/1/31
 * Time: 22:15
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Tool\Captcha\ValidateCode;

class CaptchaController extends Controller{


    public function create(Request $request){
        $validateCode = new ValidateCode;
        $request->session()->put('validate_code', $validateCode->getCode());
        return $validateCode->flat();
    }

}