@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加VIP'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="javascript:history.back(-1)" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="col-sm-12">
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">VIP名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="VIP名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">价格 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="charge" value="{{old('charge')}}" class="form-control" placeholder="价格" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">有效期（单位：天） @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="expire_days" value="{{old('expire_days')}}" class="form-control" placeholder="有效期（单位：天）" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权重（权重越大，权限越大） @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="weight" value="{{old('weight')}}" class="form-control" placeholder="权重（权重越大，权限越大）" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否显示 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <label><input type="radio" name="is_show" value="1" checked> 显示</label>
                    <label><input type="radio" name="is_show" value="0"> 不显示</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限内容(一行一条) @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <textarea name="description" class="form-control" rows="5" placeholder="权限内容(一行一条)" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">添加</button>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection