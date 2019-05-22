@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '运营'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">VIP会员</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('role.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>权重</th>
                    <th>角色名</th>
                    <th>价格</th>
                    <th>时长</th>
                    <th>显示</th>
                    <th>编辑时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->weight}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->charge}}</td>
                    <td>{{$role->expire_days}}</td>
                    <td>{{$role->statusText()}}</td>
                    <td>{{$role->updated_at}}</td>
                    <td>
                        <a href="{{route('role.edit', $role)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.destroy', ['url' => route('role.destroy', $role)])
                    </td>
                </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="8">暂无记录</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <el-row>
        <el-col :span="24">
            <etuke-a :url="''" :name="'添加'"></etuke-a>
        </el-col>
    </el-row>

@endsection