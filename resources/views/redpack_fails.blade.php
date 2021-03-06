<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>{{ env('APP_NAME','')}}</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/iconfont.css">
    <style>
    body {
        text-align: center;
    }

    .icon-fail {
        font-size: 50vw;
    }

    h2 p {
        font-size: 10vw;
        color: red;
    }

    a {
        display: block;
        width: 70vw;
        padding: 3vw 0;
        margin: 6vw auto;
        background: #fff;
        border-radius: 3vw;
    }
</style>
</head>
<body>
    <h2>
        <i class="iconfont icon-fail"></i>

        <p>{{$title?$title:'失败'}}</p>
    </h2>
    @if($title == '个人信息不完整')
        <a href="/improve">完善个人信息</a>
    @else
        <a href="/member">个人中心</a>
    @endif
    <a href="/">返回首页</a>
</body>
</html>