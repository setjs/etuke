@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加公告'])

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
            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-sm-2 control-label">公告内容 @include('components.backend.required')</label>
                    <div class="col-sm-5">
                    @include('components.backend.editor', ['name' => 'announcement', 'content' => $announcement->announcement])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        var announcement = @json($announcement);
        new Vue({
            el: '#app',
            data: function () {
                return {
                    announcement: announcement
                }
            }
        });
    </script>
@endsection