@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/plugins/flatpickr.css" rel="stylesheet">
@stop
@section('body')

    @include('components.breadcrumb', ['name' => '视频'])
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
                {{--<a href="{{ route('backend.video.index') }}" class="btn btn-primary ml-auto">返回列表</a>--}}
            </div>
        </div>

        <div class="portlet-body cf">
    <form action="" method="post">
        <div class="form-horizontal form-item">
        @csrf
        <div class="row row-cards">
            <div class="form-group">
                <label class="col-sm-2 control-label">课程 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <select name="course_id" class="form-control">
                    <option value="">请选择</option>
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->title}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">章节</label>
                <div class="col-sm-5">
                <select name="chapter_id" class="form-control">
                    <option value="">请选择</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">课程名 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="视频名" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上传视频 @include('components.backend.required')</label>
                <div class="col-sm-5">
                    @include('components.backend.video')
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">描述 @include('components.backend.required')</label>
                <div class="col-sm-5">
                @include('components.backend.editor', ['name' => 'description'])
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">视频时长 @include('components.backend.required')</label>
                <div class="col-sm-5">
                    <input type="text" name="duration" class="form-control" placeholder="视频时长" style="width: 200px" value="0" required>
                    <div class="input-group-append">
                        <span class="input-group-text">秒</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">一句话介绍 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <textarea name="short_description" class="form-control" rows="2" placeholder="一句话介绍" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上架时间 @include('components.backend.required')</label>
                <div class="col-sm-5">
                @include('components.backend.datetime', ['name' => 'published_at', 'value' => date('Y-m-d H:i:s')])
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否显示 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <label><input type="radio" name="is_show" value="{{ \App\Models\Video::IS_SHOW_YES }}" checked>是</label>
                <label><input type="radio" name="is_show" value="{{ \App\Models\Video::IS_SHOW_NO }}">否</label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">价格 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <input type="text" name="charge" placeholder="价格" class="form-control" value="{{old('charge')}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">SEO关键字 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <textarea name="seo_keywords" class="form-control" rows="2" placeholder="SEO关键字" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">SEO描述 @include('components.backend.required')</label>
                <div class="col-sm-5">
                <textarea name="seo_description" class="form-control" rows="2" placeholder="SEO描述" required></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">创建</button>
                </div>
            </div>
        </div>
        </div>
    </form>
        </div>
    </div>
@endsection

@section('script')
@include('components.backend.aliyun_upload_js')
@include('components.backend.vod')

<script>
    $(function () {
        $('select[name="course_id"]').change(function () {
            var courseId = $(this).val();
            $.getJSON(`/backend/ajax/course/${courseId}/chapters`, function (res) {
                var html = '';
                $.each(res, function (key, item) {
                    html += `<option value='${item.id}'>${item.title}</option>`;
                })
                $('select[name="chapter_id"]').html(html);
            })
        });
    });
</script>
@append