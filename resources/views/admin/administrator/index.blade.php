@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '管理员列表'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">管理员</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>
        <div class="row row-cards">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>最后登录IP</th>
                    <th>最后登录时间</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($administrators as $key=>$val)
                <tr>
                    <td>{{$val->name}}</td>
                    <td>{{$val->email}}</td>
                    <td>{{$val->last_login_ip}}</td>
                    <td>{{$val->last_login_date}}</td>
                    <td>{{$val->created_at}}</td>
                    <td>
                        <a href="{{route('admins.edit', $val)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.destroy', ['url' => route('admins.destroy', $val)])
                    </td>
                </tr>
                    @empty
                <tr>
                    <td colspan="5" class="text-center">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>
            <div class="col-sm-12">
                {{$administrators->render()}}
            </div>
        </div>
    </div>
@endsection