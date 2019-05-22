@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '编辑FAQ文章'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="col-sm-12">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <select name="category_id" class="form-control">
                        <option value="">无</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$article->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章标题 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" class="form-control" placeholder="文章标题" value="{{$article->title}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章内容 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.editor', ['name' => 'content', 'content' => $article->content])
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </form>
        </div>
    </div>

@endsection