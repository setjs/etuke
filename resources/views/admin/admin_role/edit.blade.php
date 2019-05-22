@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '编辑角色'])

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
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">角色名  @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}" placeholder="请输入角色名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Slug  @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="slug" value="{{$role->slug}}" class="form-control" placeholder="Slug" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述  @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="description" value="{{$role->description}}" class="form-control" placeholder="描述" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection