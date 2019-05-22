@extends('layouts.admin')
@section('style')
    <link href="/admins/css/basic.css" rel="stylesheet"  />
@stop
@section('body')
    @include('components.breadcrumb', ['name' => '系统'])
    <div class="row portlet light bordered" id="app-model">

        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject bold uppercase"> 菜单列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{route('menu.create')}}" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="row row-cards">

            <div class="col-sm-4 mt-2">
                <ul class="list-group">
                    @foreach($menus as $menu)
                        <li class="list-group-item">
                            <a href="{{route('menu.edit', $menu)}}">
                                <i class="fa {{$menu->action_icon}}"></i>
                                <b>{{$menu->name}}</b>
                            </a> -- {{$menu->url}}
                            @include('components.backend.delete', ['id' => $menu->id , 'url'=>route('menu.destroy') , 'title'=>'删除目录', 'class'=>'float-right'])
                        </li>
                        @foreach($menu->children as $child)
                            <li class="list-group-item child cf">
                                @include('components.backend.delete', ['id' => $child->id , 'url'=>route('menu.destroy') , 'title'=>'删除目录', 'class'=>'float-right'])
                                <a href="{{route('menu.edit', $child)}}" class="edit" >|---- {{$child->name}}</a>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection