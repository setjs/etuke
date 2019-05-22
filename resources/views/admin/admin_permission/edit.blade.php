@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '编辑权限'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">编辑菜单</span>
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
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">权限名 @include('components.backend.required')</label>
                        <div class="col-sm-5">
                            <input type="text" name="display_name" value="{{$permission->display_name}}" class="form-control" placeholder="请输入权限名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Slug @include('components.backend.required')</label>
                        <div class="col-sm-5">
                            <input type="text" name="slug" value="{{$permission->slug}}" class="form-control" placeholder="请输入Slug" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述  @include('components.backend.required')</label>
                        <div class="col-sm-5">
                            <input type="text" name="description" value="{{$permission->description}}" class="form-control" placeholder="请输入描述" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">请求方式  @include('components.backend.required')</label>
                        <div class="col-sm-5">
                            <select name="method[]" class="form-control" multiple>
                                <option value="GET" {{in_array('GET', $permission->getMethodArray()) ? 'selected' : ''}}>GET</option>
                                <option value="POST" {{in_array('POST', $permission->getMethodArray()) ? 'selected' : ''}}>POST</option>
                                <option value="POST" {{in_array('ANY', $permission->getMethodArray()) ? 'selected' : ''}}>ANY</option>
                                <option value="PUT" {{in_array('PUT', $permission->getMethodArray()) ? 'selected' : ''}}>PUT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">请求地址[支持正则表达式]  @include('components.backend.required')</label>
                        <div class="col-sm-5">
                            <input type="text" name="url" value="{{$permission->url}}" class="form-control" placeholder="请求地址[支持正则表达式]" required>
                        </div>
                    </div>
                    <div class="botton-form botton-item" >
                        <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
    $('#submit-form').click(function(){
        APP.ajax({'url':'/admin/permission/edit/{{$permission->id}}.html'},'#form',function(r){
          if(r.code == 500){
            alert('请填检查相应的数据');
          }else if(r.code == 'HY000'){
            alert('请填检查数据格式');
          }else if(r.code == 0){
            location.href = '/admin/permission.html';
          }else{
            alert(r.msg);
          }
        })
    });
    </script>
@append