@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加FAQ分类'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="portlet-body cf">
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序值（整数，升序） @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="sort" class="form-control" placeholder="排序值（整数，升序）" value="{{old('sort')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" placeholder="分类名" value="{{old('name')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection