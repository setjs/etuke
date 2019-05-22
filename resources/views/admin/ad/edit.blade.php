@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/basic.css" rel="stylesheet">
@append
@section('body')

    @include('components.breadcrumb', ['name' => '运营'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">编辑广告</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>
        <div class="portlet-body cf">
            <form id="form">
                @csrf
                <input type="hidden" name="id" value="{{$one->id}}">
                <div class="form-horizontal form-item">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="songti">*</span> 广告名称:</label>
                        <div class="col-sm-5">
                            <input type="text" maxlength="20"  class="form-control" value="{{$one->title}}" name="title" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="songti">*</span> BANNER内容:</label>
                        <div class="col-sm-5">
                            <div class="add-line-banner" id="add-one-banner">添加</div>
                            <ul class="cf banner-list" id="warp-banner">
                                @foreach(unserialize($one->content) as $key=>$val)
                                    <li >
                                        <a href="javascript:void(0)" class="delete-block" >删除</a>
                                        <div class="banner-block">
                                            <div class="img"><img src="{{$val['cover']}}"> <input type="hidden" class="img-banner" value="{{$val['cover']}}" name="content[{{$loop->index}}][cover]"></div>
                                            <input type="file" class="upload-files" >
                                        </div>
                                        <div class="block-input">
                                            <input type="text" placeholder="链接地址" class="url" value="{{$val['path']}}"  name="content[{{$loop->index}}][path]" />
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

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
    <script type="text/html" id="app-banner">
        <li >
            <a href="javascript:void(0)" class="delete-block" >删除</a>
            <div class="banner-block">
                <div class="img"></div>
                <input type="file" class="upload-files" >
            </div>
            <div class="block-input">
                <input type="text" placeholder="链接地址" class="url" name="content[@{{a}}][path]" />
            </div>
        </li>
    </script>
    <script>
        $('#submit-form').click(function(){

            APP.ajax({'url':'{{ route('post.ad.edit')}}'},'#form',function(r){
                if(r.code == 0){
                    location.href='/ad.html';
                }else{
                    alert('添加失败');
                }
            })
        });
        $('#add-one-banner').click(function(){
            var i = $('#warp-banner >li').length;
            var data = {
                a: i
            };
            html = template('app-banner', data);
            $('#warp-banner').append(html);
        })

        $(document).on('click' , '.delete-block' , function(){

            $(this).parent().remove();
            $('#warp-banner >li').each(function(i){

                $(this).find('.url').attr('name' , 'content['+i+'][path]');
                $(this).find('.img-banner').attr('name' , 'content['+i+'][cover]');
                console.log(i)
            })

        })
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
                url:'/upload/poster?str=banner&_token={{csrf_token()}}',
                dataType:'json',
                data:data,
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                //async:opt.asyncType,
                success:function(r, textStatus){
                    _this.prev('.img').html('<img src="'+r.url+'" /> <input type="hidden" class="img-banner" value="'+r.url+'" name="content['+i+'][cover]" />');
                },
                error:function(e,a, r){
                }
            });
        })
    </script>
@stop