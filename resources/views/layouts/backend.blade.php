<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ETUKE后台管理系统</title>
    <link crossorigin="anonymous" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link crossorigin="anonymous" integrity="sha384-sr24+N5hvbO83z6WV4A9zRt0bXHxKxmHiE2MliCVO6ic+CIbnJsqndMaaM6kdShS" href="https://lib.baomitu.com/flatpickr/4.5.2/flatpickr.min.css" rel="stylesheet">
    <link href="/backend/assets/css/dashboard.css" rel="stylesheet" />
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="{{route('backend.dashboard.index')}}">ETUKE</a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="ml-2 d-none d-lg-block">
                                  <span class="text-default">{{ Auth::guard('administrator')->user()->name }}</span>
                                  <small class="text-muted d-block mt-1">Administrator</small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{ route('backend.edit.password') }}">
                                    <i class="dropdown-icon fe fe-settings"></i> 修改密码
                                </a>
                                <a class="dropdown-item" href="{{ route('backend.logout') }}">
                                    <i class="dropdown-icon fe fe-log-out"></i> 安全退出
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            @foreach(backend_menus() as $menu)
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">{{$menu->name}}</a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                    @foreach($menu->children as $child)
                                            <a href="{{$child->url}}" class="dropdown-item ">{{$child->name}}</a>
                                    @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 my-md-5">
            <div class="container" id="app">
                @yield('body')
            </div>
        </div>
    </div>


    <script  src="/admins/js/jquery.min.js"></script>
    <script src="/admins/js/popper.min.js" ></script>
    <script src="/admins/js/bootstrap.min.js" ></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <script src="/admins/js/sweetalert.min.js"></script>
    <script src="/admins/js/flatpickr.min.js"></script>
    <script src="/admins/js/wangEditor.min.js"></script>
    <script>
        @if(get_first_flash('success'))
            swal("成功", "{{get_first_flash('success')}}", "success");
        @endif
        @if(get_first_flash('warning'))
        swal("警告", "{{get_first_flash('warning')}}", "warning");
        @endif
        @if(get_first_flash('error'))
        swal("错误", "{{get_first_flash('error')}}", "error");
        @endif
    </script>
    @yield('js')
</div>
</body>
</html>