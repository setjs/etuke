@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '电子书列表'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject font-dark bold uppercase">电子书列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('book.create') }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="portlet-body cf">
            <div class="row row-cards">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>电子书</th>
                    <th>价格</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->charge}}</td>
                    <td>
                        <a href="{{route('book.edit', $book)}}" class="btn btn-warning btn-sm">编辑</a>
                        @include('components.backend.destroy', ['url' => route('book.destroy', $book)])
                        <a href="{{route('book.chapter.index', $book->id)}}" class="btn btn-info btn-sm">章节</a>
                    </td>
                </tr>
                    @empty
                <tr>
                    <td class="text-center" colspan="4">暂无记录</td>
                </tr>
                @endforelse
                </tbody>
            </table>

            <div class="col-sm-12">
                {{$books->render()}}
            </div>
            </div>
        </div>
    </div>
@endsection