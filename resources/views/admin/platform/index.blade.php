@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '图片'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">专辑列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('get.platform.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="portlet-body cf">
    <div class="row row-cards">

        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>图片人名</th>
                    <th>图片标题</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list as $val)
                <tr>
                    <td>{{$val->name}}</td>
                    <td>{{$val->title}}</td>
                    <td>
                        <a href="{{route('platform.edit', $val)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.delete',  ['id' => $val->id , 'url'=>route('platform.destroy') , 'title'=>'删除目录'])
                    </td>
                </tr>
                    @empty
                <tr>
                    <td class="text-center" colspan="4">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <divc class="col-sm-12">
            {{$list->render()}}
        </divc>
    </div>
        </div>
    </div>
@endsection