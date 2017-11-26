<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;" />
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>商城</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/swiper-3.4.2.jquery.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
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
        <div class="swiper-slide">
            内裤
        </div>
        <div class="swiper-slide">
            胸罩
        </div>
        <div class="swiper-slide">
            冈本
        </div>
        <div class="swiper-slide">
            验孕棒
        </div>
    </div>
</div>

<section class="product">
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <div>
            <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
            <p><span class="right">￥159.3</span></p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <div>
            <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
            <p><span class="right">￥159.3</span></p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
        <p><span class="right">￥159.3</span></p>
        <div class="clear"></div>
    </div>
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
        <p><span class="right">￥159.3</span></p>
        <div class="clear"></div>
    </div>
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
        <p><span class="right">￥159.3</span></p>
        <div class="clear"></div>
    </div>
    <div class="pro-item">
        <img src="/images/tmp/6.jpg" alt="" width="100%">
        <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
        <p><span class="right">￥159.3</span></p>
        <div class="clear"></div>
    </div>
</section>

<footer class="footer">
    <p><img src="/images/tmp/7.png" alt=""></p>
    <p>@版权 版权 版权</p>
</footer>

<script type="text/javascript">
    $(document).ready(function () {
        new Swiper('.swiper-nav', {
            slidesPerView : 5,
            spaceBetween : 25,
        })
    });
</script>
</body>
</html>