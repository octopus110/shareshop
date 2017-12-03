<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;" />
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>商城</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/address.css">
</head>
<body>
<header class="address-header">
    <a href="/member"><img src="/images/back.png" alt="" width="12vw"></a>收货地址
</header>

<section class="address">
    <p>上海市 宝山区 环镇北路2000号 聚丰福邸 4栋 202室 李章岭收 13661645899</p>
    <a href="">编辑</a> <a href="">删除</a> <a href="">设为默认</a>
</section>

<section class="address-add">
    <a href="">+</a>
</section>


<div class="turnoff" style="display: none">
    <div data-toggle="distpicker">
      <select></select>
      <select></select>
      <select></select>
    </div>

    <input type="text" placeholder="输入详细地址"/>
    <input type="text" placeholder="联系人"/>
    <input type="text" placeholder="联系方式"/>

    <input type="submit" value="确认"/>
</div>

<footer class="footer footer-bottom">
    <p><img src="/images/tmp/7.png" alt=""></p>
    <p>@版权 版权 版权</p>
</footer>

<script src="/lib/distpicker.data.js"></script>
<script src="/lib/distpicker.js"></script>
<script>
    $("#distpicker").distpicker();
</script>
</body>
</html>