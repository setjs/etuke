<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="/admins/css/base.css" rel="stylesheet" type="text/css" />
    <link href="/admins/css/libs/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/admins/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body class=" login">
<div class="logo">后台管理系统</div>
<div class="content">
    <form class="login-form"  id="form"  >
        <div class="row">
            @csrf
            <div class="alert-danger display-hide" id="error-tips" style="display: none;"></div>
            <div class="form-group">
                <input class="form-control"   maxlength="20" autocomplete="off" type="email" name="email" value="{{old('email')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control"  maxlength="32"  autocomplete="off" type="password" name="password" required   />
            </div>
            <div class="form-group captcha">
                <input class="form-control" maxlength="4" type="text" autocomplete="off"  placeholder="请输入验证码" title="请输入验证码" name="captcha" required  />
                <img class="pointer" src="/service/create" id="v-code" onclick="this.src='/service/create?v=' + Math.random()">
            </div>
            <div class="form-actions">
                <button type="submit"  class="btn green-meadow uppercase" id="submit-form">登录</button>
            </div>
        </div>
        <div class="create-account">欢迎</div>
    </form>
</div>
<script src="/admins/js/libs/jquery.min.js"  ></script>
<script src="/admins/js/plugins/jquery.validate.js"  ></script>
<script src="/admins/js/plugins/localization/messages_zh.js"  ></script>
<script>
    {{--@if(get_first_flash('success'))--}}
    {{--swal("成功", "{{get_first_flash('success')}}", "success");--}}
    {{--@endif--}}
    {{--@if(get_first_flash('warning'))--}}
    {{--swal("警告", "{{get_first_flash('warning')}}", "warning");--}}
    {{--@endif--}}
    {{--@if(get_first_flash('error'))--}}
    {{--swal("错误", "{{get_first_flash('error')}}", "error");--}}
    {{--@endif--}}

    $("#form").validate({
      onsubmit:true,// 是否在提交是验证
      onfocusout:false,// 是否在获取焦点时验证
      onkeyup :false,// 是否在敲击键盘时验证
      errorLabelContainer: $('#form .alert-danger'),
      // wrapper:"div",

     submitHandler: function(form) { //通过之后回调
       //进行ajax传值
       $.ajax({
         url : '/login',
         type : "post",
         dataType : "json",
         data: $('#form').serialize(),
         success : function(r) {
           if(r.code == 1){
             $('#error-tips').show().html('<label id="captcha-error" class="error" for="captcha">'+r.msg+'</label>');
             //
             $('#v-code').click();
           }else if(r.code ==0){
            location.href='{{route('dashboard.index')}}';
           }
         }
       });
     },
      invalidHandler: function(form, validator) {return false;}
    });


</script>
</body>
</html>