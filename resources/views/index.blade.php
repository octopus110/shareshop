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
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
</head>
<body>

    <div class="swiper-container swiper-banner">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="/images/tmp/1.jpg" alt="" width="100%" /></div>
        <div class="swiper-slide"><img src="/images/tmp/2.jpg" alt="" width="100%"/></div>
        <div class="swiper-slide"><img src="/images/tmp/3.jpg" alt="" width="100%"/></div>
    </div>
    <div class="swiper-scrollbar"></div>
</div>

<div class="swiper-container swiper-nav">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="/images/tmp/4.png" alt="" width="100%"/>
            <p>"日"用品</p>
        </div>
        <div class="swiper-slide">
            <img src="/images/tmp/5.png" alt="" width="100%"/>
            <p>床上用品</p>
        </div>
        <div class="swiper-slide">
            <img src="/images/tmp/4.png" alt="" width="100%"/>
            <p>情趣用品</p>
        </div>
        <div class="swiper-slide">
            <img src="/images/tmp/4.png" alt="" width="100%"/>
            <p>夫妻用品</p>
        </div>
        <div class="swiper-slide">
            <img src="/images/tmp/4.png" alt="" width="100%"/>
            <p>宅男用品</p>
        </div>
    </div>
</div>

<section class="new-product">
    <div class="pro-title">
        新品上架
        <a href="" class="right">更多</a>
    </div>
    <div class="product">
        <div class="pro-item">
            <img src="/images/tmp/6.jpg" alt="" width="100%">
            <div>
                <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
                <p><span class="right">￥159.3</span></p>
            </div>
        </div>
        <div class="pro-item">
            <img src="/images/tmp/6.jpg" alt="" width="100%">
            <div>
                <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
                <p><span class="right">￥159.3</span></p>
            </div>
        </div>
        <div class="pro-item">
            <img src="/images/tmp/6.jpg" alt="" width="100%">
            <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
            <p><span class="right">￥159.3</span></p>
        </div>
        <div class="pro-item">
            <img src="/images/tmp/6.jpg" alt="" width="100%">
            <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
            <p><span class="right">￥159.3</span></p>
        </div>
    </div>
</section>

<section class="active-product">
    <div class="pro-title">
        畅销产品
        <a href="" class="right">更多</a>
    </div>
    <div class="product">
        <div class="pro-item">
            <img src="/images/tmp/8.jpg" alt="" width="100%">
            <div>
                <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
                <p>容器默认存在两根轴：水平的主轴（main axis）和垂直的交叉轴（cross axis）。</p>
                <p><span class="right">￥159.3</span></p>
                <div class="clear"></div>
            </div>
        </div>
        <div class="pro-item">
            <img src="/images/tmp/8.jpg" alt="" width="100%">
            <div>
                <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
                <p>容器默认存在两根轴：水平的主轴（main axis）和垂直的交叉轴（cross axis）。</p>
                <p><span class="right">￥159.3</span></p>
                <div class="clear"></div>
            </div>
        </div>
        <div class="pro-item">
            <img src="/images/tmp/8.jpg" alt="" width="100%">
            <div>
                <h6>【抢到就赚到】春夏秋冬 不一样的丝滑</h6>
                <p>容器默认存在两根轴：水平的主轴（main axis）和垂直的交叉轴（cross axis）。</p>
                <p><span class="right">￥159.3</span></p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <p><img src="/images/tmp/7.png" alt=""></p>
    <p>@版权 版权 版权</p>
</footer>

<script type="text/javascript">
    $(document).ready(function () {
        new Swiper('.swiper-banner', {
            autoplay: 2000,
            scrollbar:'.swiper-scrollbar',
        })
        new Swiper('.swiper-nav', {
            slidesPerView : 4,
            spaceBetween : 25,
        })
    });
</script>
</body>
</html>