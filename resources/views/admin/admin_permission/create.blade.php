@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加权限'])

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
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="display_name" class="form-control" placeholder="请输入权限名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Slug @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="slug" class="form-control" placeholder="请输入Slug" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="description" class="form-control" placeholder="请输入描述" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">请求方式 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <select name="method[]" class="form-control" multiple>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="ANY">ANY</option>
                        <option value="PUT">PUT</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">请求地址[支持正则表达式] @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="url" class="form-control" placeholder="请求地址[支持正则表达式]" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">创建</button>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection