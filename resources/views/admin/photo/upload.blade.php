@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/basic.css" rel="stylesheet">
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
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="form-group cf">
                        <label class="col-sm-2 control-label"><span style="color: red">*</span> 上传图片:  </label>
                        <div class="col-sm-5 upload-photo">
                            <div class="row fileupload-buttonbar">
                                <div class="upload-btn-label">
                                        <span class="btn btn-success fileinput-button upload-btn">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add files...</span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                    <span class="fileupload-process"></span>
                                </div>

                                <div class=" fileupload-progress fade">
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>

                            <table role="presentation" class="table table-striped">
                                <tbody class="files">
                                    @if($one->content)
                                        @foreach(unserialize($one->content) as $val)
                                    <tr class="template-download fade in">
                                        <td>
                                        <span class="preview">
                                           <img src="{{$val}}">
                                           <input type="hidden" value="{{$val}}" name="p[]">
                                        </span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a class="btn btn-danger  btn-sm delete" data-type="DELETE" data-img="{{explode('/' , $val)[4]}}" data-folder="{{explode('/' , $val)[3]}}" data-str="{{explode('/' , $val)[2]}}">
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
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
    <script src="/fileupload/js/jquery.ui.widget.js"></script>
    <script src="/fileupload/js/tmpl.min.js"></script>
    <script src="/fileupload/js/jquery.fileupload.js"></script>
    <script src="/fileupload/js/jquery.fileupload-process.js"></script>
    <script src="/fileupload/js/jquery.fileupload-ui.js"></script>
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
                <td>
                    {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                        <p class="name">{%=file.name%}</p>
                    {% } %}
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                    <p class="size">Processing...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start" disabled>
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>
    <script id="template-download" type="text/x-tmpl">

    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                   <img src="{%=file.url%}">
                   <input type="hidden" value="{%=file.url%}" name="p[]" />
                </span>
            </td>
            <td></td>
            <td>
                {% if (file.url) { %}
                    <a class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-img="{%=file.filename%}" data-folder="{%=file.folder%}" data-str="{%=file.str%}"  {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </a>
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}

    </script>
    <script>
        // teacher[temp][@{{n}}][name]
        $('#submit-form').click(function(){
            APP.ajax({'url':"{{ route('post.photo.save')}}"},'#form',function(r){
                if(r.code == 500){
                    console.log(r);
                    // alert('请填检查相应的数据');
                }else if(r.code == 'HY000'){
                    console.log(r);
                    // alert('请填检查数据格式');
                }else{
                    location.href = '/photo/{{$one->album_id}}.html';
                }
//
            })
        });
        $(function () {
            'use strict';
            $('#form').fileupload({
                url: '/poster/array.html?str=photo'
            });
        });



        $('#select-tag >span').click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active')
            }else{
                $(this).addClass('active');
            }
        })

        $(document).on('click' , '.delete',function(){
            let img=$(this).data('img');
            let folder=$(this).data('folder');
            let str=$(this).data('str');

            APP.ajax({'url':'{{route('delete.image')}}' , 'type':'get'},{'img':img , 'folder':folder , 'str':str},function(){

            })
        })
    </script>
@append