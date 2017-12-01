<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>商城</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/swiper-3.4.2.jquery.min.js"></script>
    <script type="text/javascript" src="/lib/modernizr.custom.js"></script>
    <script src="/lib/masonry.pkgd.min.js"></script>
    <script src="/lib/imagesloaded.js"></script>
    <script src="/lib/classie.js"></script>
    <script src="/lib/AnimOnScroll.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
    <link rel="stylesheet" href="/lib/component.css">
    <link rel="stylesheet" href="/lib/default.css">
</head>
<body>
<div class="swiper-container swiper-nav">
    <div class="swiper-wrapper">
        <div class="swiper-slide swiper-active">
            全部
        </div>
        <div class="swiper-slide">
            新品
        </div>
        <div class="swiper-slide">
            畅销品
        </div>
        @foreach($classify as $item)
            <div class="swiper-slide">
                {{ $item->name }}
            </div>
        @endforeach
    </div>
</div>

<section class="grid effect-2" id="grid">
    @foreach($commoditys as $item)
        <li class="pro-item">
            <img src="/uploads/{{ $item->src }}" alt="" width="100%">

            <div>
                <h6>{{ $item->name }}</h6>

                <p><span class="right">￥{{ $item->price }}</span></p>
            </div>
            <div class="clear"></div>
        </li>
    @endforeach
</section>

<footer class="footer">
    <p><img src="/images/tmp/7.png" alt=""></p>
    <p>@版权 版权 版权</p>
</footer>

<script type="text/javascript">
    $(document).ready(function () {
        new Swiper('.swiper-nav', {
            slidesPerView: 5,
            spaceBetween: 25,
        });

        new AnimOnScroll(document.getElementById('grid'), {
            minDuration: 0.4,
            maxDuration: 0.7,
            viewportFactor: 0.2
        });

        $.ajax({
            'url':'',
        });
    });
</script>
</body>
</html>