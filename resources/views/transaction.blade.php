<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>{{ env('APP_NAME','')}}</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/qrious.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/cart.css">
    <style>
        .pro_code {
            color: red;
            padding: 1.5vw 0;
        }
    </style>

    <script type="javascript">
        function getCode(url,that) {
            new QRious({
                element: $(that).next()[0],
                value: url,
                mime: "image/png",
                size: 100,
            })
        }
    </script>
</head>
<body>
<header class="cart-header">
    <a href="/member"><img src="/images/back.png" alt="" width="12vw"></a>获得红包
</header>
<section class="transactions" style="color: red;">
    * 点击购买产品进入详情微信分享即有机会获得现金红包<br>
    * 或者保存二维码自行分享给朋友也可有机会获得现金红包<br>
    * 分享后有人购买即可得到红包分成<br>
    * 获得奖金需要提供完整的个人信息（真实姓名和身份证号）
</section>

@foreach($transactions as $item)
    <section class="transactions">
        <a href="details/{{ $item->id }}/{{ $mid }}">
            【{{ $item->type?'提现':'购物' }}】{{ $item->name }} <span>{{ $item->money }}</span>
        </a>
        <p class="pro_code" onclick=getCode("{{ url('details/'.$item->id.'/'.$mid) }}",this)>点击获取产品二维码</p>
        <img alt="二维码" title="二维码"/>
    </section>
@endforeach

</body>
</html>