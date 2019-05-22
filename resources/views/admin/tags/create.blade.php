@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '图片'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">创建标签</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">
            <form id="form">
                <div class="form-horizontal form-item">
                @csrf
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 名字:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="请输入书名字" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 标题:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="请输入书名字" required>
                        </div>
                    </div>

                    <div class="botton-form botton-item" >
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
            APP.ajax({'url':"{{ route('post.tags.create') }}"},'#form',function(r){
              if(r.code == 500){
                  console.log(r);
                // alert('请填检查相应的数据');
              }else if(r.code == 'HY000'){
                  console.log(r);
                // alert('请填检查数据格式');
              }else{
                location.href = '/album.html';
              }
//
            })
        });
    </script>
@append