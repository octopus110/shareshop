<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>EOS商城</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
    <link rel="stylesheet" href="/detail/ratchet.min.css"/>
    <link rel="stylesheet" href="/detail/page.css"/>
    <link rel="stylesheet" href="/detail/product.css"/>
    <link rel="stylesheet" href="/detail/pro2.css"/>
    <script type="text/javascript" src="/lib/flex.js"></script>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/ratchet.min.js"></script>
    <script type="text/javascript" src="/lib/swiper-3.4.2.jquery.min.js"></script>
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<header class="address-header">
    <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui" style="color: #333;"></i></a>产品详情
</header>
<div id="content">
    <div class="share">
        <h6>告诉你个秘密：</h6>

        <p>分享产品到朋友圈有人购买后就能拿到奖金奥</p>
    </div>
    <div class="scroller">
        <div id="p-summary" class="page">
            <div class="container">
                <div class="swiper-container swiper-banner">
                    <div class="swiper-wrapper">
                        @foreach($images as $item)
                            <div class="swiper-slide"><img src="/uploads/{{ $item->src }}" alt="" width="100%"/></div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>

                <section id="s-title">
                    <div class="main">
                        <h1>{{ $data->name }}</h1>
                    </div>
                </section>
                <section id="s-price">
                    <span class="mui-price big">
                    <span class="mui-price-integer">￥{{ $data->price }}</span>
                    </span>
                </section>

                <ul class="table-view">
                    <li class="table-view-cell"
                        style="padding: 11px 6px 11px 15px;font-size: 16px;color:#333;">规格选择 <span
                                style="float: right;margin-right:10px;" class="clickwn"><img src="/images/next.png"
                                                                                             width="20"
                                                                                             height="20"/></span></li>
                </ul>
                <ul class="table-view" style="margin-top: 10px;">
                    <li class="table-view-cell media"><a class="">
                            <img class="media-object pull-left" src="/uploads/{{ $data->logo }}" width="12%"/>

                            <div class="media-body">
                                {{ $data->storename }}
                                <p>
                                    {{ $data->storeintroduce }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="ipo">
                    <ul class="table-view">
                        <li class="table-view-cell media">
                            <div class="media-body"> 产品详情</div>
                        </li>
                    </ul>
                    <div>
                        {!! $data->introduce !!}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        new Swiper('.swiper-banner', {
            autoplay: 2000,
            scrollbar: '.swiper-scrollbar',
        })

        /*     //两秒后隐藏提示
         $(".share").slideDown();
         window.setTimeout(function () {
         $(".share").slideUp();
         }, 3000);*/

        $(".clickwn").click(function () {
            $(".flick-menu-mask").show();
            $(".spec-menu").show();
        })

        $(".tclck").click(function () {
            $(".flick-menu-mask").hide();
            $(".spec-menu").hide();
        })
        $('#cool').bind('input propertychange', function () {
            $('.amount').html(this.value)
        }).bind('input input', function () {
        });

        $('.color a').click(function () {
            $(this).addClass('selected').siblings().removeClass('selected');
        })

        //加减面板
        $(function () {
            //加号
            $(".jia").click(function () {
                var $parent = $(this).parent(".num");
                var $num = window.Number($(".inputBorder", $parent).val());
                $(".inputBorder", $parent).val($num + 1);
                $('.amount').html($num + 1)
            });

            //减号
            $(".jian").click(function () {
                var $parent = $(this).parent(".num");
                var $num = window.Number($(".inputBorder", $parent).val());
                if ($num > 2) {
                    $(".inputBorder", $parent).val($num - 1);
                    $('.amount').html($num - 1)
                } else {
                    $(".inputBorder", $parent).val(1);
                    $('.amount').html($num)
                }
            });
        })

        //加入购物车ajax
        $(".add_cart").click(function () {
            var sum = $("#amount").text();
            var natureCotainer = $("#natureCotainer");
            var attr = natureCotainer.find('a.selected');
            var attrV = '';
            for (var i = 0; i < attr.length; i++) {
                attrV += attr.eq(i).text() + ',';
            }

            $.ajax({
                url: '/cart',
                type: 'post',
                dataType: 'json',
                data: {
                    cid: '{{ $data->id }}',
                    'sum': sum,
                    'attr': attrV,
                    'userid': '{{ $userid }}',
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    switch (data.statusCode) {
                        case 200:
                            alert('已加入购物车');
                            break;
                        case 300:
                            alert('网络不稳定，请重试');
                            break;
                        case 400:
                            alert('商品已存在');
                            break;
                    }
                }
            });
        });

        $(".buy").click(function () {
            $(".clickwn").click();
        });

        $(".directorder").click(function () {
            var natureCotainer = $("#natureCotainer");
            var attr = natureCotainer.find('a.selected');
            var amount = $("#amount");
            var attrV = '';
            var sum = 0;
            for (var i = 0; i < attr.length; i++) {
                attrV += attr.eq(i).text() + ',';
            }
            sum = parseInt(amount.text());
            $.ajax({
                url: '/create_order',
                type: 'post',
                dataType: 'json',
                data: {
                    type: 0,
                    commodityid: {
                        '{{ $data->id }}': {
                            attr: attrV,
                            sum: sum,
                        }
                    },
                    userid: '{{ $userid }}',
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.statusCode == 200) {
                        window.location.href = '/pay'
                    } else if (data.statusCode == 100) {
                        window.location.href = '/member'
                    } else {
                        alert('网络不稳定，请重试');
                    }
                }
            });
        });
    })
</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    wx.config(<?php echo $js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false) ?>);
    wx.ready(function () {
        wx.onMenuShareAppMessage({//朋友
            title: '推荐给你一个好东西',
            desc: '{{ $data->name }}',
            link: '{{ url("/details/$data->id/$openid") }}',
            imgUrl: '{{ url("uploads/".$images[0]->src) }}',
            success: function () {
                alert('分享成功,有人购买后将获得奖金');
            },
            cancel: function () {
                alert('取消分享，获得不到奖金奥');
            },
            fail: function () {
                alert('分享失败');
            }
        });
        wx.onMenuShareTimeline({//朋友圈
            title: '{{ $data->name }}',
            link: '{{ url("/details/$data->id/$openid") }}',
            imgUrl: '{{ url("uploads/".$images[0]->src) }}',
            success: function () {
                alert('分享成功,有人购买后将获得奖金');
            },
            cancel: function () {
                alert('取消分享，获得不到奖金奥');
            },
            fail: function () {
                alert('分享失败');
            }
        });
    });
</script>
</html>