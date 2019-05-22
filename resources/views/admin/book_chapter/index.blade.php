@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '章节列表'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">电子书列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('book.chapter.create', [$book->id]) }}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>
        <div class="row row-cards">

                <h3 style="margin-bottom: 16px">电子书 <b>《{{$book->title}}》</b> 的章节</h3>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>章节名</th>
                        <th>上线时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($chapters as $chapter)
                    <tr>
                        <td>{{$chapter->id}}</td>
                        <td>{{$chapter->title}}</td>
                        <td>{{$chapter->published_at}}</td>
                        <td>
                            <a href="{{route('book.chapter.edit', [$chapter->book_id, $chapter->id])}}" class="btn btn-warning btn-sm">编辑</a>
                            @include('components.backend.destroy', ['url' => route('book.chapter.destroy', [$chapter->book_id, $chapter->id])])
                        </td>
                    </tr>
                        @empty
                    <tr>
                        <td colspan="4" class="text-center">暂无记录</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>

        </div>
    </div>
@endsection
