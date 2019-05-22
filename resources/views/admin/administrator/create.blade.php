@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加管理员'])

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
                    <label class="col-sm-2 control-label">姓名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" placeholder="请输入姓名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">邮箱 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="email" class="form-control" placeholder="请输入邮箱" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" placeholder="请输入密码" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">请再输入一次密码 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="请再输入一次密码" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">角色 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <select name="role_id[]" multiple="multiple" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
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