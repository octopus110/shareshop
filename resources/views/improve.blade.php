<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>{{ env('APP_NAME','laravel')}}</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/address.css">
    <link rel="stylesheet" href="/css/iconfont.css">
    <style>
        .turnoff {
            background: none;
        }

        .turnoff  input {
            background: #fff;
            margin-top: 1vw;
        }

        .radio {
            width: 10vw !important;
            display: inline-block !important;
        }
        label{
            display: block;
            padding-left: 5vw;
            font-size: 4vw;
        }

        .radio_group {
            display: block;
            margin: 1vw auto 20px auto;
            border-radius: 5px;
            width: 90%;
            padding-left: 1vw;
            background: #fff;
            font-size: 4vw;
            padding-top: 4vw;
        }
        .blank{
            width: 100%;
            height: 6vw;
        }
    </style>
</head>
<body>
<div class="turnoff">
    <header class="address-header">
        <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui"></i></a>个人信息
    </header>
    <div class="blank"></div>
    <label for="0">
        昵称(微信昵称)：
    </label>
    <input type="text" name="realname" placeholder="用户昵称" value="{{ $data->nickname }}"/>

    <label for="0">
        注册时间：
    </label>
    <input type="text" name="realname" placeholder="注册时间" value="{{ $data->created_at }}"/>
    <form action="/improve" method="post">
        {{ csrf_field() }}
        <label for="0">
            真实姓名：
        </label>
        <input type="text" name="realname" placeholder="真实姓名" value="{{ $data->realname }}"/>
        <label for="0">
            身份证号：
        </label>
        <input type="text" name="IDnumber" placeholder="身份证号" value="{{ $data->IDnumber }}"/>

        <label for="0">
            性别：
        </label>
        <p class="radio_group" for="">
            <input type="radio" name="sex" value="0" class="radio" {{ $data->sex==0?'checked':'' }}> 男
            <input type="radio" name="sex" value="0" class="radio" {{ $data->sex==0?'':'checked' }}>女
        </p>

        <input type="submit" value="提交修改">
    </form>
</div>
</body>
</html>