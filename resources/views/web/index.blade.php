@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="/assets/css/swiper.css">
    <link href="/assets/css/home.css" rel="stylesheet"  />
@stop
@section('content')
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach(unserialize($ad->content) as $key=>$val)
                <div class="swiper-slide"><a href="{{$val['path']}}"><img src="{{$val['cover']}}"  /></a></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="body">
        <ul class="photo-list cf">
            @foreach($list as $key=>$val)
            <li>
                <div class="photo-img"><a href="{{route('detail.index',$val)}}#page=1"><img src="{{$val->thumb}}" /></a></div>
                <div class="photo-info">
                    <p>数量： {{$val->total}}P</p>
                    <p>模特：{{$val->name}}</p>
                    <p class="tag-list">标签：

                        @foreach(tagLimit($val->tag_id , $tag) as $v)
                            <a href="{{route('get.tags.index',$v['id'])}}"  class="tags">{{$v['name']}}</a>
                        @endforeach
                    </p>
                </div>
                <div class="p-title"><a href="{{route('detail.index',$val)}}#page=1" >{{$val->title}}</a></div>
            </li>
            @endforeach
        </ul>
        <div class="text-center">
            {{$list->render()}}
        </div>
    </div>

@endsection
@section('js')
    <script src="/assets/js/libs/swiper.min.js"></script>
    <script>
     var swiper = new Swiper('.swiper-container', {
       pagination: {
         el: '.swiper-pagination',
         clickable: true,
         renderBullet: function (index, className) {
           return '<span class="' + className + '"></span>';
         },
         speed:100,
         loop:true,
         autoplay:true
       }
     });

    </script>
@stop