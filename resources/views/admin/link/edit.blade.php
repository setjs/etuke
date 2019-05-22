@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '编辑友情链接'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="col-sm-12">
            <div class="form-horizontal form-item">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="sort" value="{{$link->sort}}" class="form-control" placeholder="排序（升序）" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">链接名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="name" value="{{$link->name}}" class="form-control" placeholder="链接名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">链接地址 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="url" value="{{$link->url}}" class="form-control" placeholder="链接地址" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection