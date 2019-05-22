<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>易图客-美女图片|美女写真 专注超高清美女图片分享网站</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="美女图片,美女写真,妹子,美女,mm,美女" />
    <meta name="description" content="易图客是一家专门收集整理全网超高清的美女写真网站,分享各类美女图片、丝袜美腿、性感MM、清纯妹子等极品美女写真;全部超高清无杂乱水印！" />
    <link href="{{ mix('assets/css/base.css')}}" rel="stylesheet" />
    @yield('style')
</head>
<body>
@include('components.web.header')
    <div id="app" class="app">
        @yield('content')
    </div>
@include('components.web.footer')
<script src="{{ mix('assets/js/jquery.min.js') }}"></script>

    @yield('js')
<script>
    $('#search-submit').click(function(){
        var hidd = $(this).prev().is(':hidden');
        if(hidd){
            $(this).prev().show(100);
            return false
        }

    })



    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?58046449f7bb7f61b62e9f1e13119a12";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

</body>
</html>
