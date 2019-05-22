@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/basic.css" rel="stylesheet">
@append
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
                <span class="caption-subject font-dark bold uppercase">添加图片</span>
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
                    <input type="hidden" name="album_id" value="{{$id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 标题:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="请输入书名字" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 上架时间:  </label>
                        <div class="col-sm-5">
                            @include('components.backend.datetime', ['name' => 'published_at'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 标签:  </label>
                        <div class="col-sm-5" id="select-tag" style="padding-top: 4px">
                            <input type="hidden" name="tag_id"  />
                            @foreach($tag as $val)
                                <span class="tag" data-id="{{$val->id}}">{{$val->name}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 价格:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="amount" value="{{old('amount')}}" class="form-control" placeholder="价格" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 平台:  </label>
                        <div class="col-sm-5">
                            <select multiple style="width: 300px" name="platform">
                                @foreach($platform as $val)
                                    <option value="{{$val->name}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 上传图片:  </label>
                        <div class="col-sm-5 upload-photo">
                            <div class="photo-list" id="photo-block">
                                <div class="user-photo">
                                    <div class="files-img" ></div>
                                    <input type="file" class="upload-files" />
                                </div>
                            </div>
{{--                            <div class="add-photo" id="create-photo"></div>--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> SEO关键字:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_keywords" class="form-control" rows="2" placeholder="SEO关键字" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> SEO描述:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_description" class="form-control" rows="2" placeholder="SEO描述" required></textarea>
                        </div>
                    </div>
                    @include('components.backend.image', ['name' => 'thumb', 'title' => '封面' , 'value'=>''])

                    <div class="botton-form botton-item" >
                        <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
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
        // teacher[temp][@{{n}}][name]
        $('#submit-form').click(function(){
            var tag_id = [];
            $('#select-tag >span.active').each(function(){
                tag_id.push($(this).data('id'))
            })
            $('#select-tag >input').val(tag_id.sort())
            APP.ajax({'url':"{{ route('post.photo.create')}}"},'#form',function(r){
              if(r.code == 500){
                  console.log(r);
                // alert('请填检查相应的数据');
              }else if(r.code == 'HY000'){
                  console.log(r);
                // alert('请填检查数据格式');
              }else{
                location.href = '/photo/create/{{$id}}.html';
              }
//
            })
        });

        // $('#create-photo').click(function(){
        //
        //   var i = $('#new-add-teacher >li').length;
        //   var data = {
        //     n: i
        //   };
        //   var html = template('app-teacher', data);
        //   $('#photo-block').append(html);
        //
        // })

        $(document).on('change' , '.upload-files',function(){
          var _this = $(this);
          var fileObj = this.files[0]; // js 获取文件对象

          if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
            alert("请选择图片");
            return;
          }
          var formFile = new FormData();
          formFile.append("action", "UploadVMKImagePath");
          formFile.append("file", fileObj); //加入文件对象
          var data = formFile;
//        console.log(data) ; return ;
          var i = $(this).parents('li').index();
          $.ajax({
            type:'post',
            url:'/poster.html?str=photo&_token={{csrf_token()}}',
            dataType:'json',
            data:data,
            cache: false,//上传文件无需缓存
            processData: false,//用于对data参数进行序列化处理 这里必须false
            contentType: false, //必须
            //async:opt.asyncType,
            success:function(r, textStatus){
              //opt.callback(r);
              _this.prev().html('<img src="'+r.url+'" /> <input type="hidden" value="'+r.url+'" class="img" name="p[]" />');
                var i = $('#new-add-teacher >li').length;
                var data = {
                    n: i
                };
                var html = template('app-teacher', data);
                $('#photo-block').append(html);
            },
            error:function(e,a, r){
            }
          });
        })
        $('#select-tag >span').click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active')
            }else{
                $(this).addClass('active');
            }
        })
    </script>
@append