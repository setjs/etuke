@extends('layouts.app')
@section('style')
    <link href="/assets/css/ball.css" rel="stylesheet"  />
@stop
@section('content')
    <div class="ball">
        <ul class="listbg1">
            <li><b class="lb">常用分布</b>
                <a target="_blank" href="/double/list.html">最新</a>
                <a target="_blank" href="/double/odd.html">单期</a>
                <a target="_blank" href="/double/even.html">双期</a>
                <a target="_blank" href="/double/2.html">周二</a>
                <a target="_blank" href="/double/4.html">四</a>
                <a target="_blank" href="/double/0.html">日</a>
            </li>
            <li><b class="lb">指标分布</b>
                <a target="_blank" href="/double/map.html">最新</a>
                <a target="_blank" href="double/map/odd.html">单期</a>
                <a target="_blank" href="double/map/even.html">双期</a>
                <a target="_blank" href="double/map/2.html">周二</a>
                <a target="_blank" href="double/map/4.html">四</a>
                <a target="_blank" href="double/map/0.html">日</a>
            </li>

        </ul>
    </div>


@endsection