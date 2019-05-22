@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '双色球'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject font-dark bold uppercase">双色球列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('double.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="portlet-body cf">
            <div class="row row-cards">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th style="width: 100px">日期</th>
                    <th style="width: 100px">期号</th>
                    <th style="width: 150px">号码</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list->sort() as $val)
                <tr>
                    <td>{{$val->date}}</td>
                    <td>{{$val->number}}</td>
                    <td>{{$val->r1.','.$val->r2.','.$val->r3.','.$val->r4.','.$val->r5.','.$val->r6.'+'.$val->blue}}</td>
                    <td>
                        <a href="{{route('get.double.edit', $val)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.delete', ['url' => route('double.destroy'),'title'=>'删除','id' => $val->id ])
                    </td>
                </tr>
                    @empty
                <tr>
                    <td class="text-center" colspan="4">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>

            <div class="row align-right">
                {{$list->render()}}
            </div>
            </div>
        </div>
    </div>
@endsection