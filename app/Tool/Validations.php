<?php

Validator::extend('zh_mobile', function ($attribute, $value) {
    return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[3678]|18\d)\d{8}|170[059]\d{7})$/', $value);
});
Validator::extend('alphastr', function ($attribute, $value) {
    return preg_match('/^[A-Za-z0-9]+$/', $value);
});


Validator::extend('verify_code', function ($attribute, $value, $parameters, $validator) {
    $state = User::verifyCode($validator);
    return $state && $state['overdue_at'] >= time() && $state['code'] === $value;
});

Validator::extend('is_right_orgpass', function ($attribute, $value, $parameters, $validator) {
    $state = User::verifyOrgpass($validator);
    return $state && Hash::check($value, $state);
});
Validator::extend('isCode', function($attribute, $value, $parameters, $validator) {
//    dump($attribute);
//    dump($parameters);
//    dd($validator);
    if(!empty($value) && strtolower($value) == strtolower(session('validate_code'))){
        return true;
    }
    return false;
});

Validator::extend('msm_code' , function ($attribute , $value , $parameters , $validator){

    $phone = trim($_REQUEST['phone']);

    $result = App\Models\M\SendPhoneCode::checkCode($phone,$value);

    if(empty($result)){
        return false ;
    }
    if($result->status == 0 && time() > $result->overdue_at){
        return false ;
    }
    return true ;
});
Validator::extend('find_msm_code' , function ($attribute , $value , $parameters , $validator){

    $phone = trim($_REQUEST['phone']);

    $result = App\Models\M\SendPhoneCode::findCheckCode($phone,$value);

    if(empty($result)){
        return false ;
    }
    if($result->status == 0 && time() > $result->overdue_at){
        return false ;
    }
    return true ;
});
// 检查验证码正确性
Validator::extend('sms_code' , function ($attribute , $value , $parameters , $validator){

    $phone = trim($_REQUEST['phone']);

//    $result = App\Models\M\SendPhoneCode::findCheckCode($phone,$value);
//
//    if(empty($result)){
//        return false ;
//    }
//    if($result->status == 0 && time() > $result->overdue_at){
//        return false ;
//    }
//    return true ;
});