@extends('layouts.admin')
@section('body')
    @include('components.breadcrumb', ['name' => '添加章节'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject font-dark bold uppercase">编辑菜单</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="col-sm-12">
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <input type="hidden" name="book_id" value="{{$book->id}}">
                <div class="form-group">
                    <label class="col-sm-2 control-label">章节名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" class="form-control" placeholder="请输入章节名" value="{{old('title')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">内容 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.editor', ['name' => 'content'])
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否显示 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <label><input type="radio" name="is_show" value="{{ \App\Models\BookChapter::SHOW_YES }}" checked> 是</label>
                    <label><input type="radio" name="is_show" value="{{ \App\Models\BookChapter::SHOW_NO }}"> 否</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">上架时间 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.datetime', ['name' => 'published_at'])
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