<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <title>{{ env('APP_NAME','')}}</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/qrious.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/cart.css">
    <style>
        img {
            display: block;
            margin: 2vw auto;
        }
    </style>
</head>
<body>
<header class="cart-header">
    <a href="/transaction"><img src="/images/back.png" alt="" width="12vw"></a>产品二维码
</header>
<section class="transactions" style="color: red;">
    * 保存二维码自行分享给朋友也可有机会获得现金红包<br>
    * 分享后有人购买即可得到红包分成<br>
    * 获得奖金需要提供完整的个人信息（真实姓名和身份证号）
</section>

<img id="qr"/>

<script type="text/javascript">
    (function () {
        new QRious({
            element: document.getElementById('qr'),
            value: "{{ str_replace('getCode','details',url()->full()) }}",
            size: 300,
        })
    })()
</script>
</body>
</html>