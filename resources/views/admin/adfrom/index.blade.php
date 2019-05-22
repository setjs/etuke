@extends('layouts.admin')

@section('body')

@include('components.breadcrumb', ['name' => '运营'])
<div class="row portlet light bordered cf">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-share font-dark"></i>
            <span class="caption-subject font-dark bold uppercase">推广链接</span>
        </div>
        <div class="actions">
            <div class="btn-group btn-group-devided">
                <a href="{{ route('adfrom.create') }}" class="btn btn-primary ml-auto">添加</a>
            </div>
        </div>
    </div>
    <div class="row row-cards">

        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>推广链接名</th>
                    <th>推广链接特征值</th>
                    <th>推广链接</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->from_name}}</td>
                    <td>{{$row->from_key}}</td>
                    <td>{{config('app.http')}}?from={{$row->from_key}}</td>
                    <td>
                        <a href="{{route('adfrom.edit', $row)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.destroy', ['url' => route('adfrom.destroy', $row)])
                        <a href="{{route('adfrom.number', $row)}}" class="btn btn-info btn-sm">推广效果</a>
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