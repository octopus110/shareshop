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

        input {
            background: #fff !important;
        }

        .radio {
            width: 10vw !important;
            display: inline-block !important;
        }

        label {
            display: block;
            margin: 20px auto;
            border-radius: 5px;
            width: 90%;
            padding-left: 1vw;
            background: #fff;
            font-size: 4vw;
        }
    </style>
</head>
<body>
<div class="turnoff">
    <header class="address-header">
        <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui"></i></a>完善个人信息
    </header>

    <form action="/improve" method="post">
        {{ csrf_field() }}
        <input type="text" name="realname" placeholder="真实姓名" value="{{ $data->realname }}"/>
        <input type="text" name="IDnumber" placeholder="身份证号" value="{{ $data->IDnumber }}"/>
        <label for="">
            <input type="radio" name="sex" value="0" class="radio" {{ $data->sex==0?'checked':'' }}> 男
            <input type="radio" name="sex" value="0" class="radio" {{ $data->sex==0?'':'checked' }}>女
        </label>

        <input type="submit" value="提交">
    </form>
</div>
</body>
</html>