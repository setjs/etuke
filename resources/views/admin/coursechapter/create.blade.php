@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加课程章节'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">编辑菜单</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('coursechapter.index', $course->id) }}">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>
        <div class="portlet-body cf">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序（升序） @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="sort" class="form-control" placeholder="排序（升序：小数靠前）" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">章节名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" class="form-control" placeholder="章节名" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">创建</button>
                </div>
            </form>
        </div>
    </div>

@endsection