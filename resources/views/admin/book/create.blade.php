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

    @include('components.breadcrumb', ['name' => '电子书'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject font-dark bold uppercase">添加电子书</span>
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
                        <label class="col-sm-2 control-label">@include('components.backend.required') 书名:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 描述:</label>
                        <div class="col-sm-5">
                            @include('components.backend.editor', ['name' => 'description'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 一句话描述:</label>
                        <div class="col-sm-5">
                            <textarea name="short_description" class="form-control" rows="2" placeholder="简短介绍" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 上架时间:  </label>
                        <div class="col-sm-5">
                            @include('components.backend.datetime', ['name' => 'published_at'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 是否显示:  </label>
                        <div class="col-sm-5">
                            <label><input type="radio" name="is_show" value="{{ \App\Models\Book::SHOW_YES }}" checked>是</label>
                            <label><input type="radio" name="is_show" value="{{ \App\Models\Book::SHOW_NO }}">否</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 价格:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="charge" placeholder="价格" class="form-control" value="{{old('charge')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') SEO关键字:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_keywords" class="form-control" rows="2" placeholder="SEO关键字" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') SEO描述:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_description" class="form-control" rows="2" placeholder="SEO描述" required></textarea>
                        </div>
                    </div>
                    @include('components.backend.image', ['name' => 'thumb', 'title' => '封面', 'value'=>''])

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
            APP.ajax({'url':'/book/create'},'#form',function(r){
              if(r.code == 500){
                alert('请填检查相应的数据');
              }else if(r.code == 'HY000'){
                alert('请填检查数据格式');
              }else{
                location.reload();
              }
//
            })
        });
    </script>
@append