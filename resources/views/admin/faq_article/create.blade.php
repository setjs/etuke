@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加FAQ文章'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="portlet-body cf">
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <select name="category_id" class="form-control">
                        <option value="">无</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章标题 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" class="form-control" placeholder="文章标题" value="{{old('title')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章内容 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.editor', ['name' => 'content'])
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