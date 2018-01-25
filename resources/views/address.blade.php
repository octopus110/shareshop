<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <title>{{ env('APP_NAME','laravel')}}</title>
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/address.css">
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
<body>
<header class="address-header">
    <a href="javascript:window.history.back();"><i class="iconfont icon-fanhui"></i></a>收货地址
</header>

@foreach($address as $item)
    <section class="address">
        <p>
            <a href="/address/deal/{{ $item->id }}/1">
                <i class="iconfont icon-sheweimoren {{ $item->type?'sheweimoren':'' }}"></i>
            </a>
            {{ $item->info }} {{ $item->name }} 收 {{ $item->phone }}
        </p>
        <a href="/address/edit/{{ $item->id }}"><i class="iconfont icon-bianji"></i></a>
        <a href="/address/deal/{{ $item->id }}/0"><i class="iconfont icon-shanchu"></i></a>
    </section>
@endforeach

<section class="address-add">
    <a href="javascript:;">+</a>
</section>


<div class="turnoff" style="display: none">
    <div style="width: 100vw; height: 14vw;"></div>
    <div data-toggle="distpicker">
        <select id="province"></select>
        <select id="city"></select>
        <select id="district"></select>
    </div>

    <input type="text" id="address" placeholder="输入详细地址"/>
    <input type="text" id="name" placeholder="联系人"/>
    <input type="text" id="phone" placeholder="联系方式"/>

    <input type="text" value="{{ $r }}">

    <input type="submit" value="确认" id="address_add"/>
    <input type="button" value="取消" id="address_quit"/>
</div>

<script src="/lib/distpicker.data.js"></script>
<script src="/lib/distpicker.js"></script>
<script>
    $("#distpicker").distpicker();
    $('.address-add').click(function () {
        $('.turnoff').fadeIn();
        return false;
    });
    $('#address_quit').click(function () {
        $('.turnoff').fadeOut();
    });

    $("#address_add").click(function () {
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var address = $("#address").val();
        var name = $("#name").val();
        var phone = $("#phone").val();

        if (province == '' || city == '' || district == '' || address == '' || name == '' || phone == '') {
            alert('发货地址很重要，请认真填写');
            return false;
        }

        $.ajax({
            url: '/address/{{ $r }}',
            type: 'post',
            dataType: 'json',
            data: {
                'province': province,
                'city': city,
                'district': district,
                'address': address,
                'name': name,
                'phone': phone,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                switch (data.statusCode) {
                    case 200:
                        if (data.r) {
                            window.location.href = '/pay';
                        } else {
                            window.location.reload();
                        }
                        break;
                    case 100:
                        alert('数据不完整');
                        break;
                    case 300:
                        alert('网络不稳定，请重试');
                        break;
                }
            }
        });

        return false;
    });
</script>
</body>
</html>