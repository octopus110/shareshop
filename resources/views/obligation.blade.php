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
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<header class="cart-header">
    <a href="/member"><i class="iconfont icon-fanhui"></i></a>{{ $title }}
</header>

@foreach($data as $item)
    <section class="carts">
        <div class="left checkbox">
            <input type="checkbox" class="checkbox_input" value="{{ $item->id }}"/>
        </div>

        <div class="left cart-img">
            <img src="/uploads/{{ $item->src  }}" alt="" width="100%">
        </div>

        <div class="left cart-content">
            <a href="/details/{{ $item->commodty_id }}">
                <h3>{{ $item->name }}</h3>
            </a>

            <p>
                <i class="sum">{{ $item->sum }}</i>
                <span>
                    ￥<i class="total">{{ $item->money }}</i>
                     <i style="color: #CCCCCC;">单价：<i class="price">{{ $item->price }}</i></i>
                </span>

                <a href="/order/del/{{ $item->id }}">
                    <em class="iconfont icon-shanchu"></em>
                </a>
                <em style="padding:1px 2vw;"> </em>
                <em class="iconfont icon-queren-copy submit" data_id="{{ $item->id }}"></em>
            </p>

        </div>
        <div class="clear"></div>

    </section>
@endforeach

@if($is_pay)
    <input type="button" value="支付" class="pay">
@endif

<script type="text/javascript">
    $(".submit").click(function () {
        var sum = $(this).parent().find('.sum').text();
        var total = $(this).parent().find('.total').text();

        var cart_id = $(this).attr('data_id');

        $.ajax({
            url: '/cart/deal/' + cart_id,
            type: 'post',
            dataType: 'json',
            data: {
                total: total,
                sum: sum,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                if (data.statusCode != 200) {
                    alert('数据更新失败');
                } else {
                    $(".submit").fadeOut();
                }
            }
        });
    });
    var checkbox_input = $('.checkbox_input');
    var checkbox_sum = $('.checkbox_input').length;
    var ids = '';
    alert(checkbox_sum);
    $('.pay').click(function () {
        for (var i = 0; i < checkbox_sum; i++) {
            if (checkbox_input.eq(i).is(':checked')) {
                ids += checkbox_input.eq(i).val() + ',';
            }
        }

        window.location.href = '/multiple_pay/' + ids;
    });
</script>

</body>
</html>