@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '运营'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">添加推广链接</span>
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
                    <label class="col-sm-2 control-label">推广链接名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="from_name" class="form-control" placeholder="推广链接名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">推广链接特征值 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="from_key" class="form-control" placeholder="推广链接特征值" required>
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