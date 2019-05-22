@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '图片'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">图片列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('photo.create' , $id) }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="portlet-body cf">
            <div class="row row-cards">

            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>图片标题</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->title}}</td>
                        <td>
                            <a href="{{route('photo.edit', $value)}}" class="btn btn-warning btn-sm">编辑</a>
                            <a href="{{route('photo.upload', $value)}}" class="btn btn-success btn-sm">上传图库</a>
                            @include('components.backend.delete', ['url' => route('photo.destroy'),'title'=>'删除','id' => $value->id ])
{{--                            <a href="{{route('photo.index', $value->id)}}" class="btn btn-info btn-sm">图库</a>--}}
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
            <div class="col-sm-12">
                {{$list->render()}}
            </div>
            </div>
        </div>
    </div>
@endsection