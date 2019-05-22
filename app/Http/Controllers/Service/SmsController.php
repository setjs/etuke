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

use App\Http\Controllers\Controller;
use App\Models\SmsRecord;
use Exception;
use App\Http\Requests\Frontend\SmsSendRequest;


class SmsController extends Controller {

    public function send(SmsSendRequest $request){

        $data = $request->fillData();

        if(strtolower($data['captcha']) != strtolower($request->session()->pull('validate_code'))){
            return json_encode(array('code'=>500 , 'message'=>'验证码错误') , JSON_UNESCAPED_UNICODE);
        }


        $method = 'send'.$data['method'];

        try {
            throw_if(! method_exists($this, $method), new Exception('参数错误'));

            return $this->{$method}($data['mobile']);
        } catch (Exception $exception) {
            exception_record($exception);

            return exception_response($exception, '短信验证码发送失败');
        }
    }

    public function sendRegister($mobile){


        if($mobile){

            $has = DbModels::selectField('users' , ['phone'=>$mobile]);

            if($has){
                return json_encode(['code'=>1 , 'msg'=>'对不起，此手机已被注册，请更换!']);
            }

            $r =SmsRecord::where(['mobile' => $mobile])->orderBy('id' , 'desc')->first();

            if(empty($r) || time() > $r->stime+60  ){

                $code = $code = mt_rand(1000, 9999);
                $content = '【金牌主播】验证码'. $code .'（1分钟有效），您正在进行身份验证，请勿泄露给他人。';


                $result = send_sms($content, $mobile);

                $result =  strpos($result, ',0');

                if($result >= 0) {
                    SmsRecord::createData($mobile, $code);
                    return ['code'=>0 , 'msg'=>'success', 'info'=>'验证码已发送，请在手机上查看'];
                } else {
                    return json_encode(['code'=>1 , 'info'=>'发送失败', 'msg'=>'发送失败:'.$result['stat'].'('.$result['message'].')'] );

                }
            }else{

                return json_encode(['code'=>1 , 'msg'=>'error', 'info'=>'请到手机上查看您的验证码']);
            }
        }else{
            return json_encode(['code'=>1 , 'msg'=>'error']);
        }



    }

    public function sendPasswordReset($mobile)
    {
        return $this->sendHandler($mobile, 'sms_password_reset', 'password_reset');
    }

    public function sendMobileBind($mobile)
    {
        return $this->sendHandler($mobile, 'sms_mobile_bind', 'mobile_bind');
    }

    /**
     * 发送验证码逻辑.
     *
     * @param $mobile
     * @param $sessionKey
     * @param $templateId
     *
     * @return array
     *
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     * @throws \Overtrue\EasySms\Exceptions\NoGatewayAvailableException
     */
    protected function sendHandler($mobile){

        if($mobile){

//            $has = DbModels::selectField('users' , ['phone'=>$mobile]);
//
//            if($has){
//                return json_encode(['code'=>1 , 'msg'=>'对不起，此手机已被注册，请更换!']);
//            }

            $r =SmsRecord::where(['mobile' => $mobile])->orderBy('id' , 'desc')->first();

            if(empty($r) || time() > $r->stime+60  ){

                $code = $code = mt_rand(1000, 9999);
                $content = '【金牌主播】验证码'. $code .'（1分钟有效），您正在进行身份验证，请勿泄露给他人。';


                $result = send_sms($content, $mobile);

                $result =  strpos($result, ',0');

                if($result >= 0) {
                    SmsRecord::createData($mobile, $code);
                    return ['code'=>0 , 'msg'=>'success', 'info'=>'验证码已发送，请在手机上查看'];
                } else {
                    return json_encode(['code'=>1 , 'info'=>'发送失败', 'msg'=>'发送失败:'.$result['stat'].'('.$result['message'].')'] );

                }
            }else{

                return json_encode(['code'=>1 , 'msg'=>'error', 'info'=>'请到手机上查看您的验证码']);
            }
        }else{
            return json_encode(['code'=>1 , 'msg'=>'error']);
        }
    }
}
