@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/basic.css" rel="stylesheet">
@append
@section('script')
    <script>
        var _token = '{{csrf_token()}}'
        var ids = new Array("posters");
        var cosUrl = "{{config('app.cos_img')}}"
        var name = 'thumb';
    </script>

@append
@section('body')

@include('components.breadcrumb', ['name' => '首页导航'])

<div class="row portlet light bordered" id="app-model">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> 上传图片</span>
        </div>

    </div>
    <div class="portlet-body cf">
        <form id="form">
            @csrf
            <div class="form-horizontal form-item">

                <div class="form-group">
                    <label class="col-sm-2 control-label"><span class="songti">*</span> BANNER内容:</label>
                    <div class="col-sm-5">
                        <div class="btn btn-info" id="add-one-banner">添加</div>
                        <ul class="cf banner-list" id="warp-banner">
                            <li >
                                <a href="javascript:void(0)" class="delete-block" >删除</a>
                                <div class="banner-block">
                                    <div class="img"></div>
                                    <input type="file" class="upload-files" >
                                </div>
                                <div class="block-input">
                                    <input type="text" placeholder="链接地址" class="url"  name="content[0][path]" />
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                javascript:void(0)
                <div class="botton-form botton-item">
                    <a  id="submit-form"  class="btn btn-danger">保存数据</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script src="/admins/js/template.js"></script>
    <script type="text/html" id="app-teacher">
        <div class="user-photo">
            <div class="upload-files" ></div>
            <input type="file" class="upload-files"   />
        </div>
    </script>
    <script>

        $(document).on('change' , '.upload-files',function(){
            var _this = $(this);
            var fileObj = this.files[0]; // js 获取文件对象
            var i = _this.parents('li').index();
            if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                alert("请选择图片");
                return;
            }
            var formFile = new FormData();
            formFile.append("action", "UploadVMKImagePath");
            formFile.append("file", fileObj); //加入文件对象
            var data = formFile;
//        console.log(data) ; return ;

            $.ajax({
                type:'post',
                url:'posters.html?str=opacity&_token={{csrf_token()}}',
                dataType:'json',
                data:data,
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                //async:opt.asyncType,
                success:function(r, textStatus){
                    _this.prev('.img').append('<img src="'+r.url+'" /> <input type="hidden" class="img-banner" value="'+r.url+'" name="content['+i+'][cover]" />');
                },
                error:function(e,a, r){
                }
            });
        })

    </script>
@append