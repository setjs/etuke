<!DOCTYPE html>
<html class='no-js' lang='en'>
<head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>Dashboard</title>
    <meta content='lab2023' name='author'>
    <meta content='' name='description'>
    <meta content='' name='keywords'>
    <link href="/opens/css/app.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

</head>
<body class='main page'>
@include('components.open.header')

<div id='wrapper'>
    <!-- Sidebar -->
    @include('components.open.sidebar')
    <!-- Tools -->
    <section id='tools'>
        <ul class='breadcrumb' id='breadcrumb'>
            <li class='title'>Dashboard</li>
            <li><a href="#">Lorem</a></li>
            <li class='active'><a href="#">ipsum</a></li>
        </ul>
        <div id='toolbar'>
            <div class='btn-group'>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Building'>
                    <i class='icon-building'></i>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Laptop'>
                    <i class='icon-laptop'></i>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Calendar'>
                    <i class='icon-calendar'></i>
                    <span class='badge'>3</span>
                </a>
                <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Lemon'>
                    <i class='icon-lemon'></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Content -->
    <div id='content'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <i class='icon-beer icon-large'></i>
                Hierapolis Rocks!
                <div class='panel-tools'>
                    <div class='btn-group'>
                        <a class='btn' href='#'>
                            <i class='icon-refresh'></i>
                            Refresh statics
                        </a>
                        <a class='btn' data-toggle='toolbar-tooltip' href='#' title='Toggle'>
                            <i class='icon-chevron-down'></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class='panel-body'>
                 sdfsdfdsfsd
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="https://cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js" ></script>
<script src="/opens/js/app.js" ></script>
</body>
</html>
