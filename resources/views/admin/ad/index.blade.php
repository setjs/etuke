@extends('layouts.admin')

@section('body')

@include('components.breadcrumb', ['name' => '首页导航'])

<div class="row portlet light bordered" id="app-model">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> 首页导航</span>
        </div>
        <div class="actions">
            <div class="btn-group btn-group-devided">
                <a href="{{ route('ad.create') }}" class="btn btn-primary ml-auto">添加</a>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-hover order-column dataTable no-footer">
                <thead>
                <tr>
                <tr>
                    <th  style="width: 150px;"   > 标题</th>
                    <th  style="width: 134px"> 创建时间 </th>
                    <th class="sorting"  style="width: 80px;"  > 操作 </th>
                </tr>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $val)
                    <tr >
                        <td> {{$val->title}}</td>
                        <td class="timer"> {{date('Y-m-d h:i:s' , $val->created_at)}} </td>
                        <td>
                            <a href="{{route('ad.edit', $val)}}" class="btn btn-warning btn-sm">编辑</a> |
                            @include('components.backend.delete', ['url' => route('ad.destroy'),'title'=>'删除','id' => $val->id ])
                        </td>
                    </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="5">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            {{$rows->render()}}
        </div>
    </div>
</div>
@endsection