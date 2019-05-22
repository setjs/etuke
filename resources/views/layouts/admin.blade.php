<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>后台首页</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="referrer" content="no-referrer"/>
    <meta name="csrf-token" content="{{ csrf_token()}}" id="token-id" />
    <link href="/admins/css/base.css" rel="stylesheet"  />
    <link href="/admins/css/libs/font_awesome.css" rel="stylesheet"  />
    <link href="/admins/css/libs/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/admins/css/libs/components.css" rel="stylesheet"   />
    <link href="/admins/css/layout.css" rel="stylesheet"  />
    @yield('style')
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

<div class="page-header navbar navbar-fixed-top">

    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="/">欢迎光临</a>
            <div class="menu-toggler sidebar-toggler"><span></span></div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- END TODO DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="/admins/images/layout/avatar1_small.jpg" />

                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="javascript:void(0)" id="edit-password"><i class="icon-user"></i> 密码设置 </a>
                        </li>

                        <li class="divider"> </li>
                        <li>
                            <a href="{{url('logout')}}">
                                <i class="icon-key"></i>退出</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END HEADER -->
<div class="clearfix"> </div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " >
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>

                @foreach(backend_menus() as $menu)
                    <li class="nav-item {{$menu->url == $pitch ?'start active open':''}}">
                        <a href="javascript:void(0)" class="nav-link nav-toggle" >
                            <i class="fa {{$menu->action_icon}}"></i>
                            <span class="title">{{$menu->name}}</span>
                            @if($menu->parent_id == 0)
                                <span class="arrow open"></span>
                            @endif
                        </a>
                        <ul class="sub-menu">

                            @foreach($menu->children as $child)
                                {{--<span style="color: #fff">{{Request::getPathInfo() .'---'. str_replace(".html","",$child->url) }}</span>--}}
                                <li class="nav-item start {{stripos(Request::getPathInfo() , str_replace(".html",'',$child->url))!== false ?'active open':''}}">
                                    <a href="{{$child->url}}" class="nav-link ">{{$child->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('body')
        </div>
    </div>

</div>

<div class="page-footer">
    <div class="page-footer-inner">   易图客版权所有 &copy; 2017</div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>


<script src="/admins/js/libs/jquery.min.js" ></script>
<script src="/admins/js/libs/bootstrap.min.js" ></script>
<script src="/admins/js/app.js" ></script>
<script src="/admins/js/layout.js" ></script>
<script src="/admins/js/demo.js" ></script>
<script src="/admins/js/script.js" ></script>
@stack('scripts')
@yield('script')
</body>

</html>