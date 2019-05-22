@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '编辑课程章节'])

    <div class="row row-cards">
        <div class="col-sm-12">
            <a href="{{ route('coursechapter.index', $one->course->id) }}" class="btn btn-primary ml-auto">返回列表</a>
        </div>
        <div class="col-sm-12">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序（升序） @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="sort" class="form-control" value="{{$one->sort}}" placeholder="排序（升序：小数靠前）" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">章节名 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    <input type="text" name="title" value="{{$one->title}}" class="form-control" placeholder="章节名" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </form>
        </div>
    </div>

@endsection