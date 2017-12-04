<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>mall</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/iconfont.css">
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    @yield('css','')
</head>
<body>

@yield('content','')

<nav class="nav">
    <div><a href="/">
            <i class="iconfont icon-shouye"></i>

            <p>首页</p>
        </a></div>
    <div><a href="/list">
            <i class="iconfont icon-weibiaoti--"></i>

            <p>列表</p>
        </a></div>
    <div><a href="/member">
            <i class="iconfont icon-gerenzhongxinxia"></i>

            <p>我的</p>
        </a></div>
</nav>

<footer class="footer">
    <p><img src="/images/tmp/7.png" alt=""></p>

    <p>@版权 版权 版权</p>
</footer>

@yield('js')

</body>
</html>