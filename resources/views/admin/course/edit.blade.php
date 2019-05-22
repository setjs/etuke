@extends('layouts.admin')
@section('style')
    <link  href="/admins/css/plugins/flatpickr.css" rel="stylesheet">
@stop
@section('script')
    <script>
        var _token = '{{csrf_token()}}'
        var ids = new Array("poster");
        var cosUrl = "{{config('app.cos_img')}}"
        var name = 'thumb';
    </script>
@append
@section('body')

    @include('components.breadcrumb', ['name' => '编辑课程'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold">编辑视频</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">
            <form id="form">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-horizontal form-item">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 课程名:  </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" value="{{$course->title}}" placeholder="课程名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 描述:</label>
                        <div class="col-sm-5">
                            @include('components.backend.editor', ['name' => 'description', 'content' => $course->description])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 一句话介绍:</label>
                        <div class="col-sm-5">
                            <textarea name="short_description" class="form-control" rows="2" placeholder="一句话介绍" required>{{$course->short_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 价格:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="charge" placeholder="价格" class="form-control" value="{{$course->charge}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') SEO关键字:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_keywords" class="form-control" rows="2" placeholder="SEO关键字" required>{{$course->seo_keywords}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') SEO描述:  </label>
                        <div class="col-sm-5">
                            <textarea name="seo_description" class="form-control" rows="2" placeholder="SEO描述" required>{{$course->seo_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 是否显示:  </label>
                        <div class="col-sm-5">
                            <label><input type="radio" name="is_show"
                                          value="{{ \App\Models\Course::SHOW_YES }}"
                                        {{$course->is_show == \App\Models\Course::SHOW_YES ? 'checked' : ''}}>是</label>
                            <label><input type="radio" name="is_show"
                                          value="{{ \App\Models\Course::SHOW_NO }}"
                                        {{$course->is_show == \App\Models\Course::SHOW_NO ? 'checked' : ''}}>否</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 上架时间:  </label>
                        <div class="col-sm-5">
                            @include('components.backend.datetime', ['name' => 'published_at', 'value' => $course->published_at])
                        </div>
                    </div>
                    @include('components.backend.image', ['name' => 'thumb', 'title' => '课程封面', 'value' => $course->thumb])

                    <div class="botton-form botton-item" >
                        <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection