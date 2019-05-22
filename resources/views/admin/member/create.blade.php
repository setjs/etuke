@extends('layouts.admin')
@section('script')
    <script>
      var _token = '{{csrf_token()}}'
      var ids = new Array("poster");
      var cosUrl = "{{config('app.cos_img')}}"
      var name = 'thumb';
    </script>
@append
@section('body')

    @include('components.breadcrumb', ['name' => '添加会员'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="col-sm-12">
            <form id="form">
                <div class="form-horizontal form-item">
                @csrf
                @include('components.backend.image', ['name' => 'avatar', 'title' => '头像','value'=>''])
                <div class="form-group">
                    <label class="col-sm-2 control-label">昵称 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="nickname" class="form-control" placeholder="昵称" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="mobile" class="form-control" placeholder="手机号" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="password" class="form-control" placeholder="密码" required>
                    </div>
                </div>
                <div class="botton-form botton-item">
                    <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
      $('#submit-form').click(function(){
        APP.ajax({'url':"{{route('member.post')}}"},'#form',function(r){
          if(r.code == 500){
            alert('请填检查相应的数据');
          }else if(r.code == 'HY000'){
            alert('请填检查数据格式');
          }else{
            location.href = '/member';
          }
//
        })
      });
    </script>
@append