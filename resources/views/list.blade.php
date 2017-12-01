<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
        <div class="swiper-slide">
            <a href="/list/-2/0" class="{{$id==-2?'active':''}}">全部</a>
        </div>
        <div class="swiper-slide">
            <a href="/list/-1/1" class="{{$id==-1?'active':''}}">新品</a>
        </div>
        <div class="swiper-slide">
            <a href="/list/0/2" class="{{$id==0?'active':''}}">畅销品</a>
        </div>
        @foreach($classify as $key=>$item)
            <div class="swiper-slide">
                <a href="/list/{{ $item->id }}/{{ $key+3 }}"
                   class="{{$id==$item->id?'active':''}}">{{ $item->name }}</a>
            </div>
        @endforeach
    </div>
</div>

<section class="product" id="grid">
    @if(isset($commoditys))
        @foreach($commoditys as $item)
            <div class="pro-item">
                <div class="pro-img">
                    <img src="/uploads/{{ $item->src }}" alt="" width="100%">
                </div>
                <div class="pro-info">
                    <h6>{{ $item->name }}</h6>

                    <p><span class="right">￥{{ $item->price }}</span></p>
                </div>
            </div>
        @endforeach
    @endif
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
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            initialSlide: '{{$k-2}}',
        });

        ajax_list(1);

        var flag = 1;
        var page = 2;
        var winHeight = parseFloat($(window).height());

        $(window).scroll(function (event) {
            var totalheight = winHeight + parseFloat($(window).scrollTop());
            var documentheight = parseFloat($(document).height());
            if (documentheight - totalheight <= 200) {
                if (flag) {
                    flag = 0;
                    ajax_list(page);
                    page++;
                }
            } else {
                flag = 1;
            }
        });

        function ajax_list(page) {
            $.ajax({
                url: '/ajax_list/{{ $id }}/{{$k}}',
                type: 'post',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'page': page,
                },
                success: function (data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<div class="pro-item">' +
                                '<div class="pro-img">' +
                                '<img src="/uploads/' + data[i]['src'] + '" alt="" width="100%">' +
                                '</div>' +
                                '<div class="pro-info">' +
                                '<h6>' + data[i]['name'] + '</h6>' +
                                '<p><b>' + data[i]['storename'] + '</b><span class="right">￥' + data[i]['price'] + '</span></p>' +
                                '</div>' +
                                '</div>';
                    }
                    $('#grid').append(html);
                }
            });
        }
    });
</script>
</body>
</html>