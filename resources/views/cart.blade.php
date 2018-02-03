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
</head>
<body>
    <header class="cart-header">
        <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui"></i></a>购物车
    </header>

    @foreach($carts as $item)
    <section class="carts">
        <div class="left checkbox">
            <input type="checkbox" class="checkbox_input" value="{{ $item->commodty_id }}"/>
        </div>

        <div class="left cart-img">
            <img src="/uploads/{{ $item->src  }}" alt="" width="100%">
        </div>

        <div class="left cart-content">
            <a href="/details/{{ $item->commodty_id }}">
                <h3>{{ $item->name }}</h3>

                <p class="attr">{{ $item->attr }}</p>
            </a>

            <p>
                <i class="iconfont icon-jian" onclick="commidty_sum(this,0)"></i>
                <i class="sum">{{ $item->sum }}</i>
                <i class="iconfont icon-jia" onclick="commidty_sum(this,1)"></i>
                <br/>
                <span>
                    ￥<i class="total">{{ $item->total }}</i>
                    <i style="color: #CCCCCC;">单价：<i class="price">{{ $item->price }}</i></i>
                </span>
                <em class="iconfont icon-shanchu" data-id='{{$item->id}}' onclick="cartDel(this)"></em>
            </p>
            <div class="submit" data_id="{{ $item->id }}">确认</div>
        </div>
        <div class="clear"></div>

    </section>
    @endforeach

    @if(count($carts))
    <input type="button" value="支付" class="pay">
    @endif

    <script type="text/javascript">
    //删除
    function cartDel(that){
        var msg = "确定要删除吗?";
        if(confirm(msg)==true){
         var id = $(that).attr('data-id');
         $.get('{{ url("/cart/deal") }}'+'/'+id,function(){
            window.location.reload();
         }); 
        }else{
            return false;
        }
    }


function commidty_sum(that, type) {
    var sum = $(that).parent().find('.sum');
    var total = $(that).parent().find('.total');

    var price = $(that).parent().find('.price');
    var submit = $(that).parent().parent().find('.submit');

    var cu_sum = parseFloat(sum.text());
    var t_sum = 0;

    if (type == 0) {
        if (cu_sum > 1) {
            t_sum = cu_sum - 1;
        } else {
            t_sum = cu_sum;
        }
    } else {
        t_sum = cu_sum + 1;
    }

    sum.text(t_sum);
    total.text(t_sum * parseFloat(price.text()));

    if (submit.css('opacity') == 0) {
        submit.css('opacity', 0.8);
    }
}

$(".submit").click(function () {
    var sum = $(this).prev().find('.sum').text();
    var total = $(this).prev().find('.total').text();

    var cart_id = $(this).attr('data_id');

    var that = $(this);

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
                that.css('opacity', 0);
            }
        }
    });
});

var checkbox_input = $('.checkbox_input');
var checkbox_sum = $('.checkbox_input').length;
var id = 0;
var data = [];

$('.pay').click(function () {
    for (var i = 0; i < checkbox_sum; i++) {
        if (checkbox_input.eq(i).is(':checked')) {
            id = checkbox_input.eq(i).val();
            data[id] = {
                'attr': checkbox_input.eq(i).parent().parent().find('.attr').text(),
                'sum': checkbox_input.eq(i).parent().parent().find('.sum').text()
            };
        }
    }

    if (data.length == 0) {
        alert('你没有选择产品');
        return false;
    }

    $.ajax({
        url: '/create_order',
        type: 'post',
        dataType: 'json',
        data: {
            type: 0,
            commodityid: data,
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
</script>

</body>
</html>