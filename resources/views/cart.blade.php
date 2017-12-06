<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>商城</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<header class="cart-header">
    <a href="/member"><i class="iconfont icon-fanhui"></i></a>购物车
</header>

@foreach($carts as $item)
    <section class="carts">
        <div class="left cart-img">
            <img src="/uploads/{{ $item->src  }}" alt="" width="100%">
        </div>
        <div class="left cart-content">
            <h3>{{ $item->name }}</h3>

            <p><i class="iconfont icon-jian"></i> {{ $item->sum }} <i class="iconfont icon-jia"></i> <span>￥{{ $item->price }}</span>
                <em
                        class="iconfont icon-shanchu"></em></p>
        </div>
        <div class="clear"></div>
    </section>
@endforeach

<footer class="footer footer-bottom">
    <p><img src="/images/tmp/7.png" alt=""></p>

    <p>@版权 版权 版权</p>
</footer>

</body>
</html>