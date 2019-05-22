@extends('layouts.admin')
@section('script')
    <script>
        var _token = '{{csrf_token()}}'
        var ids = new Array("poster");
        var cosUrl = "{{config('app.cos_img')}}"
        var name = 'thumb';
    </script>

@append
@section('body')

    @include('components.breadcrumb', ['name' => '编辑电子书'])

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

        <div class="col-sm-12">
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">书名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" value="{{$book->title}}" class="form-control" placeholder="请输入书名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.editor', ['name' => 'description', 'content' => $book->description])
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">一句话描述 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <textarea name="short_description" class="form-control"
                              rows="2" placeholder="简短介绍" required>{{$book->short_description}}</textarea>
                    </div>
                </div>
                @include('components.backend.image', ['name' => 'thumb', 'title' => '封面', 'value' => $book->thumb])
                <div class="form-group">
                    <label class="col-sm-2 control-label">上架时间 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.datetime', ['name' => 'published_at', 'value' => $book->published_at])
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否显示 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <label><input type="radio" name="is_show"
                                  value="{{ \App\Models\Book::SHOW_YES }}"
                                {{$book->is_show == \App\Models\Book::SHOW_YES ? 'checked' : ''}}>是</label>
                    <label><input type="radio" name="is_show"
                                  value="{{ \App\Models\Book::SHOW_NO }}"
                                {{$book->is_show == \App\Models\Book::SHOW_NO ? 'checked' : ''}}>否</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">价格 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="charge" placeholder="价格" class="form-control" value="{{$book->charge}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">SEO关键字 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <textarea name="seo_keywords" class="form-control" rows="2" placeholder="SEO关键字" required>{{$book->seo_keywords}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">SEO描述 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <textarea name="seo_description" class="form-control" rows="2" placeholder="SEO描述" required>{{$book->seo_description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
                </div>
            </form>
        </div>
        </div>
    </div>

@endsection