<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>{{ env('APP_NAME')}}</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/order.css">
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<header class="address-header">
    <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui"></i></a>确认订单
</header>

<section class="address">
    <input type="hidden" id="addressId" value="{{ $address?$address->id:0 }}">
    @if($address)
        <p><i class="iconfont icon-shoujianren"></i>收件人:&nbsp; {{ $address->name }}
            &nbsp;&nbsp;&nbsp; {{ $address->phone }}
        </p>

        <p><i class="iconfont icon-dizhi"></i>{{ $address->info }} </p>
    @else
        <a href="/address">
            <div class="add_address">
                添加地址
            </div>
        </a>
    @endif
</section>

@foreach($commdity as $k=>$item)
    <section class="commdity">
        <div class="c_img">
            <img src="/uploads/{{ $item->src }}" alt="">
        </div>
        <div class="c_info">
            <h3>{{ $item->name }}</h3>
            <h6>单价: <span class="price">￥{{ $item->price }}</span> &nbsp;&nbsp;&nbsp;
                <i class="iconfont icon-cheng"></i>{{ $order[$k]['sum'] }}</h6>

            <p>产品属性: {{ $order[$k]['attr'] }}</p>
        </div>
    </section>
@endforeach

<section class="sum">
    共 {{ $sum }} 件商品 &nbsp;&nbsp;&nbsp; 共计计：<span class="price">￥{{ $money }}</span>
</section>

<input type="button" value="支付" class="pay" id="pay">

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    wx.config(<?php echo $js->config(array('chooseWXPay'), false) ?>);
    $('#pay').click(function () {
        if ($("#addressId").val() == 0) {
            alert('发货地址不能为空');
            return false;
        }

        wx.chooseWXPay({
            timestamp: '{{$config['timestamp']}}',
            nonceStr: '{{$config['nonceStr']}}',
            package: '{{$config['package']}}',
            signType: '{{$config['signType']}}',
            paySign: '{{$config['paySign']}}',
            success: function (res) {
                window.location.href = '/pay/success';
            }
        });
    });
</script>

</body>
</html>