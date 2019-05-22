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

    @include('components.breadcrumb', ['name' => '图片'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">编辑专辑</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">

        <div class="col-sm-12">
            <form id="form">
                <div class="form-horizontal form-item">
                @csrf
                <input type="hidden" name="id" value="{{$one->id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 名字 </label>
                        <div class="col-sm-5">
                            <input type="text" name="name" value="{{$one->name}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 标题:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="title" value="{{$one->title}}" class="form-control" placeholder="请输入书名字" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 描述</label>
                        <div class="col-sm-5">
                        @include('components.backend.editor', ['name' => 'desc', 'content' => $one->text])
                        </div>
                    </div>


                    @include('components.backend.image', ['name' => 'thumb', 'title' => 'logo', 'value' => $one->thumb])
                    <div class="botton-form botton-item" >
                        <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>

@endsection

@push('scripts')

<script>
    $('#submit-form').click(function(){
        APP.ajax({'url':"{{ route('post.platform.edit')}}"},'#form',function(r){
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
@endpush