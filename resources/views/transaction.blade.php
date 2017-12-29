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
    <link rel="stylesheet" href="/css/cart.css">
</head>
<body>
<header class="cart-header">
    <a href="/member"><img src="/images/back.png" alt="" width="12vw"></a>获得红包
</header>
<section class="transactions" style="color: red;">
    * 分享你购买的产品将有机会获得红包奥
</section>

@foreach($transactions as $item)
    <section class="transactions">
        <a href="details/{{ $item->id }}/{{ $mid }}">
            【{{ $item->type?'提现':'购物' }}】{{ $item->name }} <span>{{ $item->money }}</span>
        </a>
    </section>
@endforeach

</body>
</html>