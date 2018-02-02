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
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/iconfont.css">
    @if(!$is_pay)
        <style>
            .cart-content {
                width: 67%;
            }

            .qrsh{
                width: 100%;
                padding:2vw 0;
                background: red;
                text-align: center;
                color: #fff;
                margin-top: 2vw;
            }
        </style>
    @endif
</head>
<body>
<header class="cart-header">
    <a href="/member"><i class="iconfont icon-fanhui"></i></a>{{ $title }}
</header>

@foreach($data as $item)
    <section class="carts">
        @if($is_pay)
            <div class="left checkbox">
                <input type="checkbox" class="checkbox_input" value="{{ $item->id }}"/>
            </div>
        @endif
        <div class="left cart-img">
            <img src="/uploads/{{ $item->src  }}" alt="" width="100%">
        </div>

        <div class="left cart-content">
            <a href="/details/{{ $item->commodty_id }}">
                <h3>{{ $item->name }}</h3>
                <p class="attr">属性：{{ rtrim($item->attr,',') }}</p>
            </a>

            <p>
                <i class="sum">{{ $item->sum }}</i>
                <span>
                    ￥<i class="total">{{ $item->money }}</i>
                     <i style="color: #CCCCCC;">单价：<i class="price">{{ $item->price }}</i></i>
                </span>

                @if($is_pay)
                    <a href="/order/del/{{ $item->id }}">
                        <em class="iconfont icon-shanchu"></em>
                    </a>
                @endif
            </p>
        </div>
        <div class="clear"></div>
        <div class="qrsh" data-id='{{ $item->id }}'>确认收货</div>
    </section>
@endforeach

@if($is_pay && count($data))
    <input type="button" value="支付" class="pay">
@endif

<script type="text/javascript">
    var checkbox_input = $('.checkbox_input');
    var checkbox_sum = $('.checkbox_input').length;
    var ids = [];

    $('.pay').click(function () {
        for (var i = 0; i < checkbox_sum; i++) {
            if (checkbox_input.eq(i).is(':checked')) {
                ids[i] = checkbox_input.eq(i).val() + ',';
            }
        }

        if (ids.length == 0) {
            alert('你没有选择付款订单');
            return false;
        }

        $.ajax({
            url: '/create_order',
            type: 'post',
            dataType: 'json',
            data: {
                type: 1,
                orderid: ids,
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

    $('.qrsh').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{ url('order/qrsh/')}}"+'/'+id,
            type:'get',
            success:function(){
                alert('签收成功');
                window.location.reload();
            }
        });
    });
</script>

</body>
</html>