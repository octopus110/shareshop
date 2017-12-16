<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>EOS商城</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/address.css">
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<div class="turnoff">
    <header class="address-header">
        <a href="/address"><i class="iconfont icon-fanhui"></i></a>地址编辑
    </header>

    <form action="/address/edit" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $id }}">
        <div data-toggle="distpicker">

            <select name="province" data-province="{{ $address['info'][0] }}"></select>
            <select name="city" data-city="{{ $address['info'][1] }}"></select>
            <select name="district" data-district="{{ $address['info'][2] }}"></select>
        </div>

        <input type="text" name="address" value="{{ $address['info'][3] }}" placeholder="输入详细地址"/>
        <input type="text" name="name" value="{{ $address['name'] }}" placeholder="联系人"/>
        <input type="text" name="phone" value="{{ $address['phone'] }}" placeholder="联系方式"/>

        <input type="submit" value="修改"/>
    </form>
    <a href="/address"><input type="button" value="取消"/></a>
</div>
<script src="/lib/distpicker.data.js"></script>
<script src="/lib/distpicker.js"></script>
<script>
    $("#distpicker").distpicker();
</script>
</body>
</html>