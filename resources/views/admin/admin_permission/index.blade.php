@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '权限列表'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">权限</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>权限名</th>
                    <th>Slug</th>
                    <th>描述</th>
                    <th>请求方法</th>
                    <th>请求地址</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $permission)
                <tr>
                    <td>{{$permission->display_name}}</td>
                    <td>{{$permission->slug}}</td>
                    <td>{{$permission->description}}</td>
                    <td>{{$permission->method}}</td>
                    <td><span class="badge badge-info">{{$permission->url}}</span></td>
                    <td>
                        <a href="{{route('admin.permission.edit', $permission)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.destroy', ['url' => route('admin.permission.destroy', $permission)])
                    </td>
                </tr>
                    @empty
                <tr>
                    <td class="text-center" colspan="6">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>

            <div class="row align-right">
                {{$permissions->render()}}
            </div>
        </div>
    </div>
@endsection