<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>商城</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="stylesheet" href="/detail/ratchet.min.css"/>
    <link rel="stylesheet" href="/detail/page.css"/>
    <link rel="stylesheet" href="/detail/product.css"/>
    <link rel="stylesheet" href="/detail/pro2.css"/>
    <script type="text/javascript" src="/lib/flex.js"></script>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/lib/ratchet.min.js"></script>
    <script type="text/javascript" src="/lib/swiper-3.4.2.jquery.min.js"></script>
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
</head>
<body>
<div id="content">
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
                                style="float: right;margin-right:10px;" class="clickwn"><img src="/images/next.png" width="20" height="20"/></span></li>
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
                <!-- 弹出 -->
                <div class="flick-menu-mask" style=""></div>
                <div class="spec-menu">
                    <div class="spec-menu-content spec-menu-show" style="display: block;">
                        <div class="spec-menu-top bdr-b">
                            <div class="spec-first-pic"><img id="spec_image" src="/uploads/{{ $images[0]->src }}"/>
                            </div>
                            <a class="rt-close-btn-wrap spec-menu-close">
                                <p class="flick-menu-close tclck"><img src="/images/close.png" width="24" height="24"/>
                                </p>
                            </a>

                            <div class="spec-price" id="specJdPri" style="display: block">

                                <span id="spec_price">￥ 36.80 </span></div>
                            <div id="specWeightDiv" class="spec-weight"><span>重量:</span> <span
                                        id="spec_weight">3.26kg</span></div>
                        </div>
                        <div class="spec-menu-middle">
                            <div class="prod-spec" id="prodSpecArea">
                                <div class="prod-spec" id="prodSpecArea">
                                    <div class="spec-desc"><span class="part-note-msg">已选</span>

                                        <div id="specDetailInfo_spec" class="base-txt"><span id="pro-type">白色 直袖款</span>
                                            &nbsp;&nbsp;
                                            <span class="amount">1</span>件
                                        </div>
                                    </div>
                                    <div class="nature-container" id="natureCotainer">
                                        <div class="pro-color"><span class="part-note-msg"> 颜色 </span>

                                            <p id="color">
                                                <a title="白色 直袖款" class="a-item selected J_ping"
                                                   report-eventparam="白色 直袖款">白色 直袖款</a>
                                                <a title="蓝色 直袖款" class="a-item J_ping" report-eventparam="蓝色 直袖款">蓝色
                                                    直袖款</a>
                                                <a title="黑色 直袖款" class="a-item J_ping" report-eventparam="黑色 直袖款">黑色
                                                    直袖款</a>
                                                <a title="灰色 直袖款" class="a-item J_ping" report-eventparam="灰色 直袖款">灰色
                                                    直袖款</a>
                                                <a title="粉色 直袖款" class="a-item J_ping" report-eventparam="粉色 直袖款">粉色
                                                    直袖款</a>
                                                <a title="紫色 直袖款" class="a-item J_ping"
                                                   report-eventparam="紫色 直袖款">紫色直袖款</a>
                                            </p>
                                        </div>
                                        <!--尺寸-->
                                        <!--容量-->
                                        <!--数量-->
                                    </div>
                                    <!--尺寸-->
                                    <!--容量-->
                                    <!--数量-->
                                    <div id="addCartNum" class="pro-count">
                                        <span class="part-note-msg" style="margin-right: 10px;">数量</span>

                                        <div style="width: 100%;margin-left: 10px;" class="num">
                                            <p class="jian" style="float: left;margin-top: 5px;"><img
                                                        src="/images/jian.png" width="16" height="16"></p>
                                            <input id="cool" class="inputBorder" value="1"
                                                   onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"
                                                   onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')"
                                                   type="text" maxlength="5" placeholder="数量"
                                                   style="font-size: 12px;width: 60px;height: 20px;float: left;padding: 0 5px;margin-top:3px;margin-left: 5px;"/>

                                            <p class="jia" style="float: left;margin-top: 5px;margin-left:4px;"><img
                                                        src="/images/jia.png" width="16" height="16"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--延保start-->
                            <div class="warranty-wrap bdr-t" style="display: none;">
                                <div id="spec_yanbaoInfo" class="warranty-title"> 保障服务</div>
                                <div id="spec_yanbaoItems"></div>
                            </div>
                            <!--延保end-->
                        </div>
                        <div class="flick-menu-btn spec-menu-btn"><a class="yellow-color add_cart" id="add_cart_spec"
                                                                     style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">加入购物车</a>
                            <a class="red-color directorder" id="directorder_spec"
                               style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">立即购买</a> <a
                                    class="yellow-color J_ping looksimilar looksimilara looksimilar_spec"
                                    id="looksimilar_speca" href=" " style="display: none;"
                                    report-eventid="MProductdetail_Similar" report-eventparam="W" report-eventlevel="5">查看相似</a>
                            <!--大家电-查看同款-->
                            <a class="yellow-color J_ping looksimilar looksimilarb looksimilar_spec"
                               id="looksimilar_specb" href="" style="display: none;"
                               report-eventid="MProductdetail_SameProduct" report-pageparam="" report-eventlevel="4">查看同款</a>
                            <a class="red-color J_ping arrivalInform" id="arrivalInform_spec" style="display: none;"
                               report-eventid="MProductdetail_ArrivalNotice" report-eventparam="2015246_W"
                               report-eventlevel="5">到货通知</a> <a class="red-color disabled waitingForAppointments"
                                                                 style="display: none;"
                                                                 id="waitingForAppointments_spec">等待预约</a> <a
                                    class="red-color makeAppointments" style="display: none;"
                                    id="makeAppointments_spec">立即预约</a> <a class="red-color disabled waitingForBuying"
                                                                           style="display: none;"
                                                                           id="waitingForBuying_spec">等待抢购</a> <a
                                    class="red-color buyImmediately" style="display: none;" id="buyImmediately_spec">立即抢购</a>
                            <a class="red-color disabled appointmentsEnd" style="display: none;"
                               id="appointmentsEnd_spec">预约结束</a> <a class="red-color" style="display: none;"
                                                                     id="yushou_add_cart_spec">立即预定</a></div>
                    </div>
                </div>
                <!-- 弹出 -->
                <section id="s-actionBar-container">
                    <div id="s-actionbar" class="action-bar mui-flex align-center">
                        <div class="web"><img src="/images/atm.png" width="20" height="20"/>

                            <p>联系商家</p>
                        </div>
                        <div class="web"><img src="/images/trade-assurance.png" width="20" height="20"/>

                            <p>进店</p>
                        </div>
                        <button class="cart cell">加入购物车</button>
                        <button class="buy cell">立即购买</button>
                        <div class="activity-box cell"></div>
                    </div>
                </section>
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
        //--
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

        $('#color a').click(function () {
            var cook = $(this).index();
            $('#color a').eq(cook).addClass('selected').siblings().removeClass('selected');
            $('#pro-type').text($(this).text());
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
    })
</script>
</html>