<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Pc;

use Exception;
use App\Models\SmsRecord;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Frontend\SmsSendRequest;

class SmsController extends PcController{

    public function send(SmsSendRequest $request){
        dd(2);

        $data = $request->fillData();

        $method = 'send'.$data['method'];
        dd(1);
        try {
            throw_if(! method_exists($this, $method), new Exception('参数错误'));

            return $this->{$method}($data['mobile']);
        } catch (Exception $exception) {
            exception_record($exception);

            return exception_response($exception, '短信验证码发送失败');
        }
    }

    public function sendRegister($mobile)
    {
        return $this->sendHandler($mobile, 'sms_register', 'register');
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
    protected function sendHandler($mobile, $sessionKey, $templateId)
    {
        $code = mt_rand(1000, 10000);
        session([$sessionKey => $code]);
        $config = config('sms');
        $easySms = new EasySms($config);
        $data = [
            'content' => str_replace('#code#', $code, $config['gateways'][$config['default']['gateways'][0]]['template'][$templateId]),
            'template' => $config['gateways'][$config['default']['gateways'][0]]['template'][$templateId],
            'data' => ['code' => $code],
        ];
        $sendResponse = $easySms->send($mobile, $data);
        // Log
        SmsRecord::createData($mobile, $data, $sendResponse);

        return $this->success('验证码发送成功');
    }
}
