@extends('layouts.app')
@section('style')
    <link href="/assets/css/home.css" rel="stylesheet"  />
@stop
@section('content')
    <div id="wraper" class="detail-img">
        @foreach(array_slice($arr, 0, 5) as $val)
            <img src="{{$val}}" />
        @endforeach
    </div>


    <div style="text-align: center;margin:20px auto;">
        <div id="pager" class="pager cf"></div>
    </div>

@endsection
@section('js')
    <script src="/assets/js/libs/jquery.page.js"></script>
    <script src="/assets/js/libs/template.js"></script>
    <script type="text/html" id="app-img">
        @{{each list}}
            <img src="@{{$value}}" />
        @{{/each}}

    </script>
    <script>
        $(function(){
            var json = @json($arr) ;
            var _hash = location.hash;
            var _p = _hash.replace(/[^0-9]/ig,"");
            $("#pager").zPager({
                data:json,
                current:_p,
                {{--url:'{{route('detail.ajax' , $line)}}',--}}
                totalData: '{{count($arr)}}',
                // htmlBox: $('#wraper'),
                btnShow: false,
                btnBool:false,
                // ajaxSetData:true,
                pageData:5,
                pageStep:6,
                dataRender: function(r) {
                    var start = (r.current-1)*5;
                    var end = start+5;
                    var data = {
                        list: r.data.slice(start,end)
                    };
                    var html = template('app-img', data);
                    $('#wraper').html(html);


                },
            });
        })
    </script>
@stop